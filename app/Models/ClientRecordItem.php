<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecordItem extends Model
{
    protected $table = 'tb_client_record_items';
    protected $fillable = ['item_id ', 'client_record_id', 'quantity', 'item-total'];    
    protected $primaryKey = 'id'; 
     
     
     
     

    public function getClientRecord()
    {
        return $this->hasOne('App\Models\CientRecord', 'client_id', 'id');
        //$item->getBrand()->name;
    }
    public function getItem()
    {
        return $this->hasOne('App\Models\item', 'item_id', 'id');
        //$item->getBrand()->name;
    }
}
