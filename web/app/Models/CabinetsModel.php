<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinetsModel extends Model
{
	protected $table      = 'cabinets';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'name',
        'camera_address'
	];
}
