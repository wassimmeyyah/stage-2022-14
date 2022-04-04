<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porteur extends Model
{

    use HasFactory;
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


    protected $table='porteur';
    protected $primaryKey ='PORTCode';


    protected $keyType = 'int';
    public $incrementing ='true';
    protected $connection ='mysql';
    /**
     * @var mixed
     */

    public function etablissement()
    {
        return $this->belongsToMany(Etablissement::class, 'coordination', 'PORTCode', 'ETABCode');

    }
}
