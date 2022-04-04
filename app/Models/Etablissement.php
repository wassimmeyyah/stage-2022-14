<?php

namespace App\Models;

use App\Models\Porteur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Etablissement extends Model
{

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
    use HasFactory;

    protected $table = 'etablissement';
    protected $primaryKey = 'ETABCode';


    protected $keyType = 'string';
    public $incrementing = 'false';
    protected $connection = 'mysql';
    /**
     * @var mixed
     */

    /* public function territoire(){
        return $this->hasOne(Territoire::class);
    }*/
    public function territoire()
    {
        return $this->belongsTo('territoire', 'TERRCode');
    }

    public function specialite()
    {
        return $this->hasOne(Specialite::class);
    }

    public function type()
    {
        return $this->belongsTo('type', 'TYPCode');
    }

    public function ville()
    {
        return $this->hasOne(Ville::class);
    }

    public function porteur()
    {
        // return $this->belongsTo('porteur', 'ETABCode');

        // return $this->belongsTo('porteur', 'ETABCode');
        return $this->belongsToMany(Porteur::class, 'coordination', 'ETABCode', 'PORTCode');
    }

    public function inspecteur()
    {
        // return $this->belongsTo('porteur', 'ETABCode');

        // return $this->belongsTo('porteur', 'ETABCode');
        return $this->belongsToMany(Inspecteur::class, 'coordination', 'ETABCode', 'PORTCode');
    }

    public function coordination()
    {
        return $this->belongsTo('coordination', 'ETABCode');
    }
}
