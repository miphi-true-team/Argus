<?php

namespace App\Http\Controllers\CRUD;

use App\Models\GroupsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Runner\Filter\GroupFilterIterator;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Models\GroupsModel  $groupsModel
     * @return \Illuminate\Http\Response
     */
    public function show(GroupsModel $groupsModel)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupsModel  $groupsModel
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupsModel $groupsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupsModel  $groupsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupsModel $groupsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupsModel  $groupsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupsModel $groupsModel)
    {
        //
    }
}
