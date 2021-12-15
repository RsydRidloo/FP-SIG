<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'kecamatan' => DB::table('kecamatan')->count(),
            'spesialis' => DB::table('spesialis')->count(),
            'rumahsakit' => DB::table('rumah_sakit')->count(),
            'user' => DB::table('users')->count(),
        ];
        return view('v_home', $data);
    }
}
