<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Merchants extends Controller
{
  public function merchants()
  {
    return view('content.admin.merchants');
  }

  public function merchantsLocations()
  {
    return view('content.admin.merchantLocations');
  }

  public function parkingLots()
  {
    return view('content.admin.parkingLots');
  }

  public function users()
  {
    return view('content.admin.users');
  }
}
