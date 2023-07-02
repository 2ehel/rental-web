<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
            public function index()
        {
            return view('profile.profile_view');
        }

        public function edit ()
        {
            
        }
}
