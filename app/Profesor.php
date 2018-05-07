<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use SoftDeletes;
    protected $table = 'profesor';
    protected $primaryKey = 'idprofesor';
    public $timestamps = false;
    protected $guarded = [];

    public function practica(){
        return $this->hasMany('App\Practica');
    }

    public function escuela(){
        return $this->belongsTo('App\Escuela', 'idescuela', 'idescuela');
    }

    public function coordinador(){
        return $this->hasMany('App\Coordinador');
    }
}
