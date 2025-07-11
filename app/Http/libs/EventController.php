<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = [
            [
                'title' => 'イベント 1',
                'start' => '2023-06-11'
            ],
            [
                'title' => 'イベント 2',
                'start' => '2023-06-15'
            ]
        ];

        return response()->json($events);
    }
}
