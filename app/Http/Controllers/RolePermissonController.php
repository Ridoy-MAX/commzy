<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissonController extends Controller
{
    //
    public function role(){
        $permissions = Permission::latest()->get();
        $roles = Role::latest()->paginate(6);
        return view('role_permission.role', [
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }
    
    public function assign_role(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', "%$search%")
                     ->orWhere('email', 'like', "%$search%")
                     ->latest()->paginate(6);
        $roles = Role::all();
        
        return view('role_permission.assign', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }



    function store_role(Request $request)
    {
        $validatedData = $request->validate([
            'role_name' => 'required|unique:roles,name|max:255',
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,name',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create([
                'name' => $validatedData['role_name'],
                'guard_name' => 'web',
            ]);

            // Retrieve the selected permissions
            $permissions = Permission::whereIn('name', $validatedData['permission'])->get();

            // Manually sync the permissions of the role
            $role->syncPermissions($permissions);

            DB::commit();

            return back()->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollBack();
            // Handle or log the exception
            // ...

            return back()->with('danger', $e->getMessage());
        }
    }


    public function updateRole(Request $request, $roleId)
    {
        $validatedData = $request->validate([
            'role_name' => 'required|unique:roles,name,'.$roleId.'|max:255',
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($roleId);
        $role->name = $validatedData['role_name'];
        $role->save();

        // Sync the permissions of the role
        $permissions = Permission::whereIn('name', $validatedData['permission'])->get();
        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }


    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();

        return back()->with('success', 'Role deleted successfully.');
    }


    public function assignRole(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::findOrFail($userId);
        $previousRole = $user->roles()->first(); // Get the previous role assigned to the user

        if ($previousRole) {
            $user->removeRole($previousRole); // Remove the previous role
        }
        $role = Role::where('name', $validatedData['role'])->firstOrFail();

        $user->assignRole($role);

        return redirect()->back()->with('success', 'Role assigned to user successfully.');
    }

}
