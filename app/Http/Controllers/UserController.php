<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Proposal;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    //

    // public function userlist(Request $request): View
    // {
    //     return view('userlist', [
    //         'user' => $request->user(),
    //     ]);
    // }

    public function dashboard(){
        $completedeservice = Order::where('status', 'complete')
            ->where(function($query) {
                $query->where('seller_id', auth()->id())
                      ->orWhere('client_id', auth()->id());
            })
            ->count();
    
        $processeservice = Order::where('status', 'in process')
            ->where(function($query) {
                $query->where('seller_id', auth()->id())
                      ->orWhere('client_id', auth()->id());
            })
            ->count();
        $cancelservice = Order::where('status', 'cancel')
            ->where(function($query) {
                $query->where('seller_id', auth()->id())
                      ->orWhere('client_id', auth()->id());
            })
            ->count();

    
        $totalReviews = Review::where('seller_id', auth()->id())->count();
    
        return view('dashboard', compact('completedeservice', 'processeservice', 'totalReviews','cancelservice'));
    }
    

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', "%$search%")
                     ->orWhere('username', 'like', "%$search%")
                     ->orWhere('email', 'like', "%$search%")
                     ->get(0);

        return view('userlist', ['users' => $users]);
    }
    public function userlist()
    {
        $users = User::latest()->get();
        return view('userlist', compact('users'));
    }
    
    public function blocklist(Request $request)
    {
        $search = $request->input('search');
        $blockusers = User::onlyTrashed()
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->latest()->paginate(6);

        return view('blocklist', compact('blockusers'));
    }


    public function restore(Request $request)
    {
        $userId = $request->input('id');
        $user = User::withTrashed()->find($userId);
    
        if (!$user) {
            abort(404, 'User not found');
        }
    
        $user->restore();
    
        return redirect()->back()->with('success', 'User unblock successfully!');
    }
public function user_create(Request $request)
{
    // Validate the form data with custom messages
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/'],
        'password' => 'required|string|min:8',
    ], [
        'name.required' => 'The name field is required.',
        'name.max' => 'The name must not exceed 255 characters.',
        'username.required' => 'The username field is required.',
        'username.regex' => 'The username must contain both letters and numbers.',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already taken.',
        'email.max' => 'The email must not exceed 255 characters.',

        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    // Redirect the user after creating the account with a success message
    return redirect()->route('userlist')->with('success', 'User created successfully!');
}



public function user_update(Request $request, $id)
{
    // Validate the form data with custom messages
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'email|max:255|unique:users,email,' . $id,
        'username' => ['required', 'string', 'max:255', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/'],
        'password' => 'nullable|string|min:8',
    ], [
        'name.required' => 'The name field is required.',
        'name.max' => 'The name must not exceed 255 characters.',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already taken.',
        'email.max' => 'The email must not exceed 255 characters.',
        'username.required' => 'The username field is required.',
        'username.regex' => 'The username must contain both letters and numbers.',
        'username.max' => 'The username must not exceed 255 characters.',
        'password.min' => 'The password must be at least 8 characters long.',
    ]);

    $user = User::find($id);

    // Update only if the fields are not empty
    $user->name = $request->input('name');
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = $request->input('password') ? bcrypt($request->input('password')) : $user->password;

    $user->save();

    return redirect()->back()->with('success', 'User updated successfully!');
}


// $users = User::whereNull('deleted_at')->get();

public function user_block(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        abort(404, 'User not found');
    }

    $user->delete();

    return redirect()->back()->with('success', 'User account blocked successfully!');
}



}
