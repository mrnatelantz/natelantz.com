<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\MyActivities;

class HomeController extends Controller
{
    public function index()
    {
    	$activities = new MyActivities();
    	
    	return view('home', ['activities' => $activities->all()]);

    }
}
