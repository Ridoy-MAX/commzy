<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function markAllAsRead(Request $request)
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
