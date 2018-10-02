<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecordService extends Model
{
    protected $table = 'tb_client_record_services';
    protected $fillable = ['service_id', 'client_record_id', 'quantity', 'service_total'];    
    protected $primaryKey = 'id'; 

    public function getClientRecord()
    {
        return $this->hasOne('App\Models\CientRecord', 'client_id', 'id');
        //$item->getBrand()->name;
    }
}
