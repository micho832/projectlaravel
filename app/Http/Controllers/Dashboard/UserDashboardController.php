<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(){
        $users=User::paginate(5);
        return view('dashboard.users',compact('users'));
    }
}
