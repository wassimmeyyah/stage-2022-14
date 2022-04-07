<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accompagnement2 extends Model
{
    use HasFactory;
    protected $table='accompagnement';
    protected $primaryKey = array('EXPCode','PACode');


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
