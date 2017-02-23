<?php

namespace crggWebsite\Http\Controllers;

use Illuminate\Http\Request;

use crggWebsite\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
      return view('dashboard.index');
    }
}
