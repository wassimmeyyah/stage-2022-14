<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{

    use HasFactory;
    public $timestamps = false;
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


    protected $table='archive';
    protected $primaryKey ='EXPCode';


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */

    public function porteur()
    {

        return $this->belongsToMany(Porteur::class, 'accompagnement', 'EXPCode', 'PORTCode');

    }
    public function personelacad()
    {

        return $this->belongsToMany(Personnelacad::class, 'accompagnement', 'EXPCode', 'PACode');

    }
    public function thematique()
    {

        return $this->belongsToMany(Thematique::class, 'thematique_abordee', 'EXPCode', 'THEMACode');

    }

}
