<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function form()
    {
        return view('users.create');
    }

    public function create(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $data = compact('name', 'email', 'password');
        DB::table("users")->insert($data);
        return view("users.message", [
            "message" => "User created successfully"
        ]);
    }

    public function table()
    {
        $users = DB::table("users")->select()->get();
        $data = compact('users');
        return view('users.table', $data);
    }

    public function drop($id)
    {
        DB::table("users")->delete($id);
        return response()->json(["success" => true]);
    }
}
