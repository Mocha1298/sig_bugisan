<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tringan = 'Ringan'; $tsedang = 'Sedang'; $tberat = 'Berat';
        $total = DB::table('kerusakan')->count();
        $ringan = DB::table('detail')->where('Level_Kerusakan',$tringan)->count();
        $sedang = DB::table('detail')->where('Level_Kerusakan',$tsedang)->count();
        $berat = DB::table('detail')->where('Level_Kerusakan',$tberat)->count();
        return view('be.dashboard.dashboard',['total'=>$total,'ringan'=>$ringan,'sedang'=>$sedang,'berat'=>$berat,'tringan'=>$tringan,
        'tsedang'=>$tsedang, 'tberat'=>$tberat]);
    }
}
