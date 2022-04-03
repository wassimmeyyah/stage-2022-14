<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $table='specialite';
    protected $primaryKey ='SPECode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
}
