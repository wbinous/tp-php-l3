<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Notifications\Notifiable;

class Etudiants extends Model implements Authenticatable
{
    use BasicAuthenticatable;

    public $table = "etudiants";
    protected $primaryKey = "idEtudiant";
    public $timestamps = false;
    protected $hidden = ['motDePasse', 'remember_token'];
    protected $fillable = ['nom', 'prenom', 'numeroIdentite', 'dateNaissance', 'adressePostale', 'tel', 'mail', 'motDePasse'];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return $this->remember_token;
    }
}
