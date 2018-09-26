<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'tb_brands';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
}
