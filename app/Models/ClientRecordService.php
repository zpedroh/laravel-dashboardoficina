<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecordService extends Model
{
    protected $table = 'tb_client_records';
    protected $fillable = ['client_id ', 'user_id', 'record-total', 'status', 'plaque'];    
    protected $primaryKey = 'id'; 
 

    public function getClientRecord()
    {
        return $this->hasOne('App\Models\CientRecord', 'client_id', 'id');
        //$item->getBrand()->name;
    }
}
