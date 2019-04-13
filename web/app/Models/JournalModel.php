<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalModel extends Model
{
	protected $table      = 'mephi_journal';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'cabinet_id',
        'student_id',
        'date',
        'para_num'
	];
}
