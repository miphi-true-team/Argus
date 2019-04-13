<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PairsModel extends Model
{
	protected $table      = 'pairs';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'full_caption',
        'short_caption',
        'start_time',
        'end_time'
	];
}
