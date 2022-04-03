<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territoire extends Model
{
    use HasFactory;

    protected $table='territoire';
    protected $primaryKey ='TERRCode';

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }


    protected $keyType = 'string';
    public $incrementing ='false';
    protected $connection ='mysql';

   /* public function etablissement(){
        return $this->belongsTo('etablissement', 'TERRCode');
    }*/
    public function etablissement(){
        return $this->hasOne(Etablissement::class);
    }
}
