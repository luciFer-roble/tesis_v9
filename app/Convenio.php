<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use SoftDeletes;
    protected $table = 'convenio';
    protected $primaryKey = 'idconvenio';
    public $timestamps = false;
    protected $guarded = [];

    public function empresa(){
        return $this->belongsTo('App\Empresa', 'idempresa', 'idempresa');
    }
}
