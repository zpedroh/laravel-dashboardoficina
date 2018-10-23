<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = 'tb_adresses';
    protected $fillable = ['client_id', 'provider_id', 'complement', 'state', 'zipcode', 'city', 'district', 'street', 'number'];
    protected $primaryKey = 'id';
    
}
