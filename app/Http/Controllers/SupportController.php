<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Support;
use App\Models\SupportChat;
use Illuminate\Http\Request;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SupportTicketCreated;
use Image;

class SupportController extends Controller
{
    //
    public function support()
    {
        $supports = Support::where('user_id', auth()->user()->id)->latest()->paginate(6);
        $adminsupports = Support::latest()->latest()->paginate(6);
        return view('support.support', compact('supports','adminsupports'));
    }

    // public function support(){
    //     $supports = Support::latest()->latest()->paginate(6);
    //     return view('support.support', compact('supports'));

    // }
    public function support_view($id){
        $supports = Support::find($id);
        $support_chats = SupportChat::where('support_id', $id)->get();
        return view('support.supportView', compact('supports', 'support_chats'));
    }
    
    public function support_create(Request $request){
        $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|string|in:High,Medium,Low',
            'status' => 'required|string|in:Open,Close,Pending',
            'description' => 'required|string',
            'attachment' => 'file|max:2048', // assuming maximum file size is 2MB
        ]);
    
        $user_id = Auth::user()->id;
   
        // Check if attachment is provided
        if ($request->hasFile('attachment')) {
            $filename = time().'.'.$request->file('attachment')->getClientOriginalExtension();
            $attachmentPath = $request->file('attachment')->move('attachments', $filename,  'public');
        } else {
            $attachmentPath = null; // Set to null if no attachment is provided
        }
    
        $support = Support::create([
            'user_id' => $user_id,
            'subject' => $request->subject,
            'priority' => $request->priority,
            'status' => $request->status,
            'description' => $request->description,
            'attachment' => $attachmentPath, // Save the path to the attachment
        ]);

        $user = Auth::user();

        // $user->notify(new SupportTicketCreated($support));
    
        return back()->with('support', 'Support ticket created successfully!');
    }
    
    public function support_update(Request $request, $id){
        $request->validate([
           
            'status' => 'required|string|in:Open,Close,Pending',
        
        ]);

        $support = Support::find($id);
    
        $support->status = $request->input('status');
    
        $support->save();

        return back()->with('support_update', 'Support ticket update successfully!');

    }

    // public function support_destroy($id)
    // {
    //     Support::destroy($id);
    //     return back()->with('success', 'Support record deleted successfully!');
    // }

    public function support_chat(Request $request, $id){

        $user_id = Auth::user()->id;
        $support = Support::find($id);
      // Check if attachment is provided
            if ($request->hasFile('attachment')) {
                // Store the attachment in the 'public' disk under 'attachments' directory
                $filename = time().'.'.$request->file('attachment')->getClientOriginalExtension();
                $attachmentPath = $request->file('attachment')->move('attachments/chat', $filename,  'public');
            } else {
                $attachmentPath = null; // Set to null if no attachment is provided
            }
        // Check if the support ticket exists
        if ($support) {
            SupportChat::create([
                'user_id' => $user_id,
                'support_id' => $support->id, // Set the support_id to the actual support ticket ID
                'message' => $request->message,
                'attachment' => $attachmentPath,
                'created_at'=>Carbon::now(),
            ]);
    
            return back();
        }
    
        // Handle the case when the support ticket does not exist (you might want to redirect to an error page or show a message)
        // For example:
        return redirect()->route('error.page')->with('error', 'Support ticket not found.');
    }
    
    

    
}
