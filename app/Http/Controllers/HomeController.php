<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fashion;

class HomeController extends Controller
{
    public function index(){
        $fashions = \Auth::user()->fashions()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'fashions' => $fashions,
        ];
        return view('home', $data);
    }
}
