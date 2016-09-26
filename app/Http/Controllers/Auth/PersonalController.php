<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;

class PersonalController extends Controller
{
    public function getPersonal()
    {
        if (Auth::check()) {
            
        } else {
            return Redirect::to('/login');
        }
    }
}
