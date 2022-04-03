<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordination extends Model
{
    use HasFactory;

    protected $table='coordination';
    protected $primaryKey = array('ETABCode', 'PORTCode','INSPCode');


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
