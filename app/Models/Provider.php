<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'tb_providers';
    protected $fillable = ['name', 'cnpj'];
    protected $primaryKey = 'id';
}
