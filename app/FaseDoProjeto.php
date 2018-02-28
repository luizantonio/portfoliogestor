<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseDoProjeto extends Model
{
    // Fields then update by web requests, using label fillable
	protected $fillable = ['status_do_projeto',];
}
