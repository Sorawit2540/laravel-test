<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

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
        $images = $images = DB::table('photo')->get();
        $catalog = $catalog = DB::table('catalog')->get();
        return view('home',compact('images',$images,'catalog',$catalog));
    }
    public function catalog()
    {
        $catalog = $catalog = DB::table('catalog')
        ->get();
        return view('catalog',compact('catalog',$catalog));
    }
}
