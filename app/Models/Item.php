<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'tb_items';
    protected $fillable = ['name', 'location', 'price', 'brand_id', 'category_id', 'model'];    
    protected $primaryKey = 'id';

    public function getBrand()
    {
        return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
        //$item->getBrand()->name;
    }

    public function getCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function getItemStock()
    {
        return $this->hasOne('App\Models\ItemStock', 'item_id', 'id');
    }   
    
}

