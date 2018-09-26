<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $table = 'tb_item_stocks';
    protected $fillable = ['quantity'];    
    protected $primaryKey = 'id';
}
