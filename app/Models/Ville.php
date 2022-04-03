<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $table='ville';
    protected $primaryKey ='VILCode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
}
