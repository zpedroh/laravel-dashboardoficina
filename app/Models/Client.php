<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'tb_clients';
    protected $fillable = ['name', 'cpf', 'telephone'];
    protected $primaryKey = 'id';

    public function getAdress()
    {
        return $this->hasOne('App\Models\Adress', 'client_id', 'id');
    }

    public function getRecords()
    {
        return $this->hasMany('App\Models\ClientRecord', 'client_id', 'id');
    }
}
