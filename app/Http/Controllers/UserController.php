<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class UserController extends Controller
{
    public function index()
        {
            $users = [
                (object) ['id' => 1, 'name' => 'Jack', 'email'=> 'jack@email.com'],
                (object) ['id' => 2, 'name' => 'Harry', 'email'=> 'harry@gmail.com'],
            ];

            return view('users.index', compact('users'));
        }

        public function show($id)
        {

            return view('users.show', compact('id'));
        }
}
