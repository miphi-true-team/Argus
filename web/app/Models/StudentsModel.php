<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
	protected $table      = 'Students';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'sn',
        'fn',
        'pt',
        'group_id'
	];
}
