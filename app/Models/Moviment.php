<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moviment extends Model
{
    protected $table = 'tb_moviments';
    protected $fillable = ['mov_type', 'quantity', 'item_id', 'client_record_item_id'];    
    protected $primaryKey = 'id';
}
