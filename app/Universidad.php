<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use SoftDeletes;
    protected $table = 'universidad';
    protected $primaryKey = 'iduniversidad';
    public $timestamps = false;
    protected $guarded = [];

    public function sede(){
        return $this->hasMany('App\Sede');
    }

}
