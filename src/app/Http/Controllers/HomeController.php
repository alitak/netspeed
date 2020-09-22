<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $ping_data = [];
        foreach (\App\Models\PingData::whereDate('created_at', '>=', \Carbon\Carbon::now()->subMonths(1))->get() as $pd) {
            $ping_data[$pd['server']][] = [
                'created_at' => $pd['created_at']->format('U') . '000',
                'packet_loss' => $pd['packet_loss'],
            ];
        }

        return view('home.index', compact('ping_data'));
    }

}
