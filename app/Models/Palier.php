<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palier extends Model
{
    use HasFactory;

    protected $table='palier';
    protected $primaryKey ='PALCode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
