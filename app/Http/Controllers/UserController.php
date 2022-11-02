<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user'  => $this->service->handleGetUserById(auth()->id())
        ];
        return view('dashboard.profiles.edit', $data);
    }

    /**
     * update user
     * 
     * @param ProfileRequest $request
     * @param User $user
     */
    public function updateUser(ProfileRequest $request, User $user)
    {
        $this->service->handleUpdateUserById($request, auth()->id());
        return back()->with('success', 'Berhasil mengedit profile!');
    }

    public function resetPassword(ProfileRequest $request)
    {
        // dd($request);
        $this->service->handleUpdatePasswordUserById($request, auth()->id());
        return back()->with('success', 'Berhasil memperbarui password!');
    }
}
