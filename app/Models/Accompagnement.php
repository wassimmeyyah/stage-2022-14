<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accompagnement extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table='coordination';
    protected $primaryKey = array('EXPCode', 'PORTCode','PACode');


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
}
