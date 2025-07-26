<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

   public function create()
    {
        return view('admin.users.create');
    }




    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6',
            'bio'             => 'nullable|string',
            'user_type'       => 'nullable|in:user,consultant,admin',
            'specialization'  => 'nullable|string|max:255',
            'experience'      => 'nullable|string|max:255',
            'whatsapp'        => 'nullable|string|max:20',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role'            => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|string|min:6',
            'bio'             => 'nullable|string',
            'user_type'       => 'nullable|in:user,consultant,admin',
            'specialization'  => 'nullable|string|max:255',
            'experience'      => 'nullable|string|max:255',
            'whatsapp'        => 'nullable|string|max:20',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role'            => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
