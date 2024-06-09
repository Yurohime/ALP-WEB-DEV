<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session; // Make sure to import the Session facade

class DashboardController extends Controller
{
    public function index()
    {
        
        // Retrieve user ID from session
        $userId = session('user_id');

        // Use the user ID for further processing...

        // Return view or perform other actions
    }
}
