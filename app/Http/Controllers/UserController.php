<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('status', 'desc')->get(); // Order by status in descending order
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->userService->createUser($request);

        return redirect(route('user.index'))->with('success', 'لقد تم اضافة الموظف بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $this->userService->updateUserInfo($user, $request);
        $this->userService->updateUserPassword($user, $request);

        $user->status = (int) $request->status;
        $user->save();

        return redirect(route('user.index'))->with('success', 'لقد تم تعديل بيانات هذا الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $this->userService->freezeUser($user);

        return redirect()->route('user.index')->with('success', 'لقد تم تجميد هذا الموظف بنجاح');
    }
}
