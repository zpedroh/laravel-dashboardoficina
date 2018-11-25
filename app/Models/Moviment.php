<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moviment extends Model
{
    protected $table = 'tb_moviments';
    protected $fillable = ['mov_type', 'quantity', 'item_id', 'client_record_id', 'price'];    
    protected $primaryKey = 'id';

    public function getItem()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}
