<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderItem extends Model
{
    protected $table = 'tb_provider_items';
    protected $fillable = ['item_id', 'value', 'provider_id'];    
    protected $primaryKey = 'id';

    public function getItem()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}
