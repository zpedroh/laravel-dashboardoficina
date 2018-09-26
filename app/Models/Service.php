<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'tb_services';
    protected $fillable = ['name', 'price'];
    protected $primaryKey = 'id';
}
