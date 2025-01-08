<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class UserController extends Controller
{
    // Declare a public variable
    public $users;

    // Initialize the variable in the constructor
    public function __construct()
    {
        $this->users = [
            (object) ['id' => 1, 'name' => 'Jack', 'email'=> 'jack@email.com'],
            (object) ['id' => 2, 'name' => 'Harry', 'email'=> 'harry@gmail.com'],
        ];
    }
    
    public function index()
        {
            $users = $this->users;
            return view('users.index', compact('users'));
        }

        public function show($id)
        {

            $user = collect($this->users)->firstWhere('id', $id);

            return view('users.show', compact('user'));
        }
}
