<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabinetsModel;
use App\Models\GroupsModel;
use App\Models\StudentsModel;
use App\Models\PairsModel;
use PHPUnit\Runner\Filter\GroupFilterIterator;

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
        $students = StudentsModel::get();

        $studentsByGroups = [];

        foreach ($students as $student) {
            $studentsByGroups[GroupsModel::where('id', $student['group_id'] )->get()->first()->name  ][] = $student;
        }

        // echo "<pre>";
        // print_r($studentsByGroups);
        // echo "</pre>";

        // exit;

        return view('home', [
            'cabinets' => CabinetsModel::get(),
            'count_students' => StudentsModel::get()->count(),
            'groups' => GroupsModel::get(),
            'studentsByGroup' => $studentsByGroups
        ]);
    }

    public function profile()
    {
        return view('employee/profile');
    }

    public function schedule()
    {
        return view('employee/schedule', [
            'groups' => GroupsModel::get(),
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
    
    public function journal()
    {
        return view('employee/journal', [
            'groups' => GroupsModel::get(),
            'pairs' => PairsModel::get()
        ]);
    }

}
