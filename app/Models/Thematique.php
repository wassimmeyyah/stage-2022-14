<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    use HasFactory;

    protected $table='thematique';
    protected $primaryKey ='THEMACode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
