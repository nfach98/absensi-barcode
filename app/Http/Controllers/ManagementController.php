<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ManagementController extends Controller
{
    public function index()
    {
    	$users = User::all();
        return view('management', ["users" => $users]);
    }
}
