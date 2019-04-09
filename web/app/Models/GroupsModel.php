<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupsModel extends Model
{
	protected $table      = 'Groups';
	protected $primaryKey = 'id';
    public $timestamps    = false;
    
	protected $fillable = [
        'name'
	];
}
