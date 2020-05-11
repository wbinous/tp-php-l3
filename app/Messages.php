<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public $table = "messages";
    protected $primaryKey = "idMessage";
    public $timestamps = false;
}
