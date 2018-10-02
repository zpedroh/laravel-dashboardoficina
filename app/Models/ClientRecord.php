<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecord extends Model
{
    protected $table = 'tb_client_records';
    protected $fillable = ['client_id', 'user_id', 'record_total', 'status', 'plaque'];    
    protected $primaryKey = 'id'; 
 

    public function getClient()
    {
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    public function getItems()
    {
        return $this->hasOne('App\Models\ClientRecordItem', 'id', 'client_record_id');
    }

    public function getServices()
    {
        return $this->hasOne('App\Models\ClientRecordService', 'id', 'client_record_id');
    } 
}
