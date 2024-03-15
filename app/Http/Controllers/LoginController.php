<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class LoginController extends Controller
{
    public function login(Request $request, ApiService $apiService)
    {

        $email = $request->post('email');
        $password = $request->post('password');

        $response = $apiService->login($email, $password);
        if ($response) {
            session()->put('logged_in', true);
            session()->put('user', $response);
            return redirect()->route('authors');
        } else {
            return back()->withErrors(['Invalid email or password']);
        }
    }
}
