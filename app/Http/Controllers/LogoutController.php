<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request){
        
            // Remove specific custom session keys
            session()->forget(['user', 'api_token']);

            // Invalidate session and regenerate CSRF token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            session()->flash('message', 'You have been logged out successfully.');

            return redirect()->route('login');
        }
}
