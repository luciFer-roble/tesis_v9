<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorE extends Model
{
    use SoftDeletes;
    protected $table = 'tutore';
    protected $primaryKey = 'idtutore';
    public $timestamps = false;
    protected $guarded = [];

    public function practica(){
        return $this->hasMany('App\Practica');
    }

    public function empresa(){
        return $this->belongsTo('App\Empresa', 'idempresa', 'idempresa');
    }

}
