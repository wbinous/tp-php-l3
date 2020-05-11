<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    public $table = "formation";
    protected $primaryKey = "idFormation";
    public $incrementing = false;
    public $timestamps = false;
}
