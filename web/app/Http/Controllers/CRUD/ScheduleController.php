<?php

namespace App\Http\Controllers\CRUD;

use App\Models\ScheduleModel;
use App\Models\CabinetsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupsModel;
use App\Models\PairsModel;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScheduleModel  $scheduleModel
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleModel $scheduleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduleModel  $scheduleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleModel $scheduleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduleModel  $scheduleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleModel $scheduleModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduleModel  $scheduleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleModel $scheduleModel)
    {
        //
    }

    public function getSchedule($group)
    {
        $data = ScheduleModel::where('groups_id', $group)
            ->orderBy('day', 'asc')
            ->orderBy('para_num', 'asc')
            ->get();

        $pairsByDay = [];
        foreach ($data as $row) {
            $pairsByDay[PairsModel::where('id', $row['day'])->get()->first()->full_caption][] = $row;
            $row['cabinet_id'] = CabinetsModel::where('id', $row['cabinet_id'])->get()->first()->name;
        }

        return view('employee.schedule.table', ['pairsByDay' => $pairsByDay]);;
    }

}
