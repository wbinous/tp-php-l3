<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossiers extends Model
{
    public $table = "dossiers";
    protected $primaryKey = "idDossier";
    public $timestamps = false;
}
