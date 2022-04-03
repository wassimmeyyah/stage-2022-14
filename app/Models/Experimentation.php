<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experimentation extends Model
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

    protected $table='experimentation';
    protected $primaryKey ='EXPCode';


    protected $keyType = 'int';
    public $incrementing ='false';
    protected $connection ='mysql';
    /**
     * @var mixed
     */








}
