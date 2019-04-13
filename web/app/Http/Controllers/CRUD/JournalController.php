<?php

namespace App\Http\Controllers\CRUD;

use App\Models\JournalModel;
use App\Models\GroupsModel;
use App\Models\PairsModel;
use App\Models\ScheduleModel;
use App\Models\StudentsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalController extends Controller
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
     * @param  \App\Models\JournalModel  $journalModel
     * @return \Illuminate\Http\Response
     */
    public function show(JournalModel $journalModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JournalModel  $journalModel
     * @return \Illuminate\Http\Response
     */
    public function edit(JournalModel $journalModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JournalModel  $journalModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JournalModel $journalModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JournalModel  $journalModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(JournalModel $journalModel)
    {
        //
    }

    public function getJournalByDate($group, $date)
    {
        $journalRecords = JournalModel::where('date', $date)->get();

        $students = [];

        foreach ($journalRecords as $journalRecord) {
            $students[$journalRecord['student_id']] = StudentsModel::where('id', $journalRecord['student_id'])->get()->first();

        }
        
        echo "Count pars: ". ScheduleModel::where('para_num',  $journalRecords[0]['para_num'])->get()->count();

echo "<pre>";
        print_r($students);
        echo "</pre>";
exit;

        return view('employee/journal/journal', [
            'students' => $students
        ]);
    }

}
