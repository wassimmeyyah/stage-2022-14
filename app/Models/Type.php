<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table='type';
    protected $primaryKey ='TYPCode';


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';

    public function etablissement(){
        return $this->hasOne(Etablissement::class);
    }
}
