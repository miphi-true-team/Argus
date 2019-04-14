<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
	protected $table      = 'schedule';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'day',
        'para_num'.
        'groups_id',
        'predmet',
        'prepod'
	];

}
