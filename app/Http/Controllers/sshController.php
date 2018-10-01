<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sshController extends Controller
{
    public function pull(){
        exec('cd /home/mansor/webapps/app_vinculacion/tesis_v9;git pull origin;');

    }
}
