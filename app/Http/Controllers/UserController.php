<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getListUser()
    {
        $users = $this->user->getUser();
        return view('admin.list_user', compact('users'));
    }
    public function editUser($id)
    {
        $userDetail = $this->user->userDetail($id);
        return view('admin.edit_user', compact('userDetail'));
    }
    public function updateUser(Request $request, $id)
    {
        try {
            $this->user->updateInformation($request, $id);
            return redirect()->route('getlistuser');
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function removeUser($id)
    {
//        try {
//
//        } catch (\Exception $ex) {
//
//        }
        try {
            $this->user->removeUser($id);
            return redirect()->route('getlistuser');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
}
