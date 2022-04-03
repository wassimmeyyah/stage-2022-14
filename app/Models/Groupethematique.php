<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupethematique extends Model
{
    use HasFactory;

    protected $table='groupe_thematique';
    protected $primaryKey ='GTCode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
