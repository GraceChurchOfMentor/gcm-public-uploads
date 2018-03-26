<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function show()
    {
        return view('upload');
    }
}
