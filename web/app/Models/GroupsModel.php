<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentsModel;

class GroupsModel extends Model
{
	protected $table      = 'Groups';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'name'
	];

	public function getCountStudents()
	{
		return StudentsModel::where('group_id', $this->id)->get()->count();
	}

	public function getStudents()
	{
		return StudentsModel::where('group_id', $this->id)->orderBy('sn', 'asc')->get();
	}

}
