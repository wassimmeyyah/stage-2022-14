<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique_abordee extends Model
{
    use HasFactory;

    protected $table='thematique_abordee';
    protected $primaryKey = array('EXPCode', 'THEMACode');


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */
}
