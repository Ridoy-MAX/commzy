<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountApproval;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AccountApprovalController extends Controller
{
    //

    public function account_approval(Request $request)
    {
        $search = $request->input('search');
        $approvalusers = AccountApproval::with('rel_to_user')
                                       ->whereHas('rel_to_user', function($query) use ($search) {
                                           $query->where('name', 'like', "%$search%")
                                                 ->orWhere('email', 'like', "%$search%");
                                       })
                                       ->latest()->paginate(6);
        $roles = Role::all();

        return view('account_approval.approval', [
            'approvalusers' => $approvalusers,
            'roles' => $roles,
        ]);
    }





    public function user_approval(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'approval' => 'required', // Validate the approval status
         
        ]);
    
        // Update the AccountApproval table with the approval status
        AccountApproval::where('id', $id)->update([
            'approval' => $validatedData['approval'],
        ]);
    
        // Get the user ID from the AccountApproval model
        $approvaluser = AccountApproval::findOrFail($id);
        $userId = $approvaluser->user_id;
    
        // Assign the selected role to the user
        $user = User::findOrFail($userId);
        $role = Role::where('name', 'seller')->firstOrFail();
    
        $user->assignRole($role); // Assign the selected role to the user
    
        return redirect()->back()->with('success', 'Account approved and role assigned successfully.');
    }
    
}
