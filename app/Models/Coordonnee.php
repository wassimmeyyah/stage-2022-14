<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    use HasFactory;

    protected $table='coordonnees';
    protected $primaryKey ='COORDCode';


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
