<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(){
        return "Hello World";
    }


}
