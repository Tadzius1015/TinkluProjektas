<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UsersListRepository
{
    public function getAllUsers()
    {
        $users = User::all()->toArray();

        return $users;
    }

    public function getByID($id)
    {
        $user = User::find($id);

        return $user;
    }

    public function updateUserByID($id, Request $request)
    {
        if ($user = User::find($id)) {
            $user->name = $request['name'];
            $user->surname = $request['surname'];
            $user->role = $request['role'];
            $user->email = $request['email'];

            $user->save();

            return true;
        }
        else {
            return false;
        }
    }
}