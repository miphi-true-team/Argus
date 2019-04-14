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
        $day = date('w', strtotime($date));
        $journalRecords = JournalModel::where('date', $date)->get();
        $countOfPairs = ScheduleModel::where([
            ['day', '=', $day],
            ['groups_id', '=', $group]
        ])->get()->count();
        
        $students = [];

        foreach ($journalRecords as $journalRecord) {
            
            $student = StudentsModel::where([
                ['id', '=', $journalRecord['student_id']],
                ['group_id', '=', $group],
            ])->get()->first();
            
            if (!empty($student)) {
                $count_of_admission = 0;
                $students[$journalRecord['student_id']] = [
                    'sn' => $student->sn,
                    'fn' => $student->fn,
                    'pt' => $student->pt
                ];
                
                $pairs = JournalModel::select('para_num')->where('student_id', $journalRecord['student_id'])->get();
    
                if (!empty($pairs)) {
                    foreach ($pairs as $pair) {
                        $subject = ScheduleModel::where([
                            ['day', '=', $day],
                            ['para_num', '=', $pair->para_num]
                        ])->get()->first();
    
                        if (!empty($subject)) {
                            $students[$journalRecord['student_id']]['pairs'][] = "[".$pair->para_num."] ".$subject->predmet;
                            $count_of_admission++;
                        }
                        
                    }
    
                    if ($countOfPairs > 0) {
                        $students[$journalRecord['student_id']]['precent'] = ($count_of_admission * 100)/$countOfPairs;
                    } else {
                        $students[$journalRecord['student_id']]['precent'] = ($count_of_admission * 100)/1;
                    }
                }

            }

        }

        return view('employee/journal/journal', [
            'students' => $students
        ]);
    }

}
