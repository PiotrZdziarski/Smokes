<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DebugController extends Controller
{
  public function adminsol()
  {
    return view('sites.adminsol');
  }
}
