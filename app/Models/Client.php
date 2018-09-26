<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'tb_clients';
    protected $fillable = ['name', 'cpf', 'country', 'state', 'zipcode', 'city', 'district', 'street', 'number'];
    protected $primaryKey = 'id';
}