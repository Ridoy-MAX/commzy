<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $authenticate_user = Auth::user();
        $conversations = $authenticate_user->conversations;

        $participants = collect();
        $uniqueParticipants = collect();
        foreach ($conversations as $conversation) {
            $conversationParticipants = $conversation->participants->except($authenticate_user->id);
            $participants = $participants->merge($conversationParticipants);
            $uniqueParticipants = $participants->unique();
        }

        $users = $uniqueParticipants;

        return view('message.index', [
            'users' => $users,
        ]);
    }

    public function open_conversation(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $receiverId = $user->id;
        $authenticate_user = Auth::user();

        $userIds = [Auth::id(), $user->id];
        sort($userIds); // Sort the user IDs to ensure consistent order

        // Generate a unique conversation identifier by concatenating user IDs and hashing
        $uniqueIdentifier = md5(implode('-', $userIds));

        // Check if a conversation with the unique identifier exists
        $conversation = Conversation::where('unique_identifier', $uniqueIdentifier)->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = new Conversation;
            $conversation->unique_identifier = $uniqueIdentifier;
            $conversation->save();

            // Attach users to the conversation
            $conversation->participants()->attach($userIds);

            $message = new Chat();
            $message->sender_id = Auth::id();
            $message->conversation_id = $conversation->id;
            $message->receiver_id = $receiverId;
            $message->message = $authenticate_user->name." has joined the conversation. You can now send messages to eachother.";
            $message->save();
        }
        // Retrieve the conversation's messages
        $conversation = Conversation::find($conversation->id);
        $messages = $conversation->chats;
        // dd($conversation->id);

        $conversations = $authenticate_user->conversations;

        $participants = collect();
        foreach ($conversations as $conversation) {
            $conversationParticipants = $conversation->participants->except($authenticate_user->id);
            $participants = $participants->merge($conversationParticipants);
            $uniqueParticipants = $participants->unique();
        }

        $users = $uniqueParticipants;

        return view('message.open_conversation', [
            'users' => $users,
            'user' => $user,
            'messages' => $messages,
            'receiverId' => $receiverId,
            'conversation' => $conversation,
        ]);
    }

    public function delete_conversation(Request $request)
    {
        $conversation = Conversation::find($request->conversation_id)->delete();
        if (!$conversation) {
            return redirect()->back()->with('error', 'Conversation not found.');
        }

        return redirect()->route('message.inbox')->with('success', 'Conversation has been deleted.');
    }

    public function sendMessage(Request $request, $receiverId)
    {
        $senderId = auth()->user()->id; // Assuming you are using authentication
        $messageText = $request->input('message');
        $userIds = [$senderId, $receiverId];
        sort($userIds); // Sort the user IDs to ensure consistent order

        // Generate a unique conversation identifier by concatenating user IDs and hashing
        $uniqueIdentifier = md5(implode('-', $userIds));
        // Check if a conversation exists; create one if it doesn't
        $conversation = Conversation::where('unique_identifier', $uniqueIdentifier)->first();
        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->unique_identifier = $uniqueIdentifier;
            $conversation->save();

            // Attach the participants to the conversation
            $conversation->participants()->attach([$senderId, $receiverId]);
        }

        // Create a new message and associate it with the conversation
        $message = new Chat();
        $message->sender_id = $senderId;
        $message->conversation_id = $conversation->id; // Set the conversation_id to the correct conversation
        $message->receiver_id = $receiverId;
        $message->message = $messageText;
        $message->save();
        // broadcast(new SendMessage($message))->toOthers();

        return response()->json(['status' => 'Message sent']);
    }

    public function broadcast(Request $request, $receiverId)
    {
        $senderId = auth()->user()->id; // Assuming you are using authentication
        $messageText = $request->input('message');
        $userIds = [$senderId, $receiverId];
        sort($userIds); // Sort the user IDs to ensure consistent order

        // Generate a unique conversation identifier by concatenating user IDs and hashing
        $uniqueIdentifier = md5(implode('-', $userIds));
        // Check if a conversation exists; create one if it doesn't
        $conversation = Conversation::where('unique_identifier', $uniqueIdentifier)->first();
        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->unique_identifier = $uniqueIdentifier;
            $conversation->save();

            // Attach the participants to the conversation
            $conversation->participants()->attach([$senderId, $receiverId]);
        }

        // Create a new message and associate it with the conversation
        $message = new Chat();
        $message->sender_id = $senderId;
        $message->conversation_id = $conversation->id;
        $message->receiver_id = $receiverId;
        $message->message = $messageText;
        $message->save();
        broadcast(new PusherBroadcast($message))->toOthers();
        return view('message.broadcast', ['message' => $message]);
    }

    public function receive(Request $request)
    {
        return view('message.receive', ['message' => $request->message]);
    }
}
