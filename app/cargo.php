<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    protected $guarded = [
	'id',
	'nome',
	'direx'
    ];

    protected $table = "cargos";
}