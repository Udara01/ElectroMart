<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {   
        $meta_data = [
            'title' => 'Home',
            'description' => 'Welcome to our website!'
        ];

        return view('home', $meta_data);
    }

    public function login(): string{

        $meta_data = [
            'title' => 'Login',
            'description' => 'Login to your account'
        ];

        return view('auth/login', $meta_data);
    }

    public function register(): string{

        $meta_data = [
            'title' => 'Register',
            'description' => 'Create a new account'
        ];

        return view('auth/register', $meta_data);
    }

    public function catalog(): string{
        return view('pages/shop');
    }
}
