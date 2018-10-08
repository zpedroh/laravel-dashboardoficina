<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecordService extends Model
{
    protected $table = 'tb_client_record_services';
    protected $fillable = ['service_id', 'client_record_id', 'quantity', 'service_total'];    
    protected $primaryKey = 'id'; 

    public function getService()
    {
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
}
