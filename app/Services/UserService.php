<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Prepare data for creating a new user.
     */
    public function prepareUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 1,
        ];
    }

    /**
     * Update user information.
     */
    public function updateUserInfo(User $user, $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
    }

    /**
     * Update user password.
     */
    public function updateUserPassword(User $user, $request)
    {
        if (!empty($request->password)) {
            if (!Hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }
    }

    /**
     * Create a new user.
     */
    public function createUser($request)
    {
        $userData = $this->prepareUserData($request);
        User::create($userData);
    }

    /**
     * Freeze a user by updating their status.
     */
    public function freezeUser(User $user)
    {
        $user->status = 0;
        $user->save();
    }
}
