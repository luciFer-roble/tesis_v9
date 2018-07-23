<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Practica extends Model
{
    use SoftDeletes;
    protected $table = 'practica';
    protected $primaryKey = 'idpractica';
    public $timestamps = false;
    protected $guarded = [];

    public function actividad(){
        return $this->hasMany('App\Actividad');
    }

    public function tutore(){
        return $this->belongsTo('App\TutorE', 'idtutore', 'idtutore');
    }
    public function profesor(){
        return $this->belongsTo('App\Profesor', 'idprofesor', 'idprofesor');
    }
    public function estudiante(){
        return $this->belongsTo('App\Estudiante', 'idestudiante', 'idestudiante');
    }
    public function periodoacademico(){
        return $this->belongsTo('App\PeriodoAcademico', 'idperiodoacademico', 'idperiodoacademico');
    }

    public function documentop(){
        return $this->hasMany('App\DocumentoP');
    }
}
