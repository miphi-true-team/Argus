<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabinetsModel;
use App\Models\GroupsModel;

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
    public function home()
    {
        return view('home', [
            'cabinets' => CabinetsModel::get()
        ]);
    }

    public function cabinets()
    {
        return view('employee/cabinets', [
            'cabinets' => CabinetsModel::get()
        ]);
    }

    public function groups()
    {
        return view('employee/groups', [
            'groups' => GroupsModel::get()
        ]);
    }

}
