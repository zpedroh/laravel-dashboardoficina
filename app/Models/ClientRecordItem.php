<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecordItem extends Model
{
    protected $table = 'tb_client_record_items';
    protected $fillable = ['item_id', 'client_record_id', 'quantity', 'item_total'];    
    protected $primaryKey = 'id'; 

}
