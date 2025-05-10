<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    // Rolleri listeleme
    public function index()
{
    $users = \App\Models\User::with('roles')->get();
    $roles = \App\Models\Role::all();
    return view('roles.index', compact('users', 'roles'));
}
    // Role atama
    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        // Kullanıcıya rolü ata
        $user->roles()->attach($role);

        return back()->with('success', 'Role assigned successfully!');
    }

    // Rolü çıkarma
    public function removeRole($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId);

        return back()->with('success', 'Role removed successfully!');
    }
}
