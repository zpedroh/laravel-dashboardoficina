<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $table = 'tb_item_stocks';
    protected $fillable = ['quantity', 'quantity_min', 'item_id'];    
    protected $primaryKey = 'id';

    public function getItem()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}
