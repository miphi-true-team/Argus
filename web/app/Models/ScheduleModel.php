<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
	protected $table      = 'mephi_schedule';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'day',
        'para_num'.
        'cabinet_id',
        'groups_id',
        'predmet',
        'prepod'
	];

}
