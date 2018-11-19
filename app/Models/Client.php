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
}
