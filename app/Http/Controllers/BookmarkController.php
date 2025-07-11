<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store($fashionId){
        $user = \Auth::user();
        if (!$user->is_bookmark($fashionId)){
            $user->bookmark_fashions()->attach($fashionId);
        }
        return back();
    }
    public function destroy($fashionId){
        $user = \Auth::user();
        if ($user->is_bookmark($fashionId)){
            $user->bookmark_fashions()->detach($fashionId);
        }
        return back();
    }
}
