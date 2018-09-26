<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecord extends Model
{
    protected $table = 'tb_client_records';
    protected $fillable = ['client_id ', 'user_id', 'record-total', 'status', 'plaque'];    
    protected $primaryKey = 'id'; 
 

    public function getClient()
    {
        return $this->hasOne('App\Models\Cient', 'id', 'client_id');
        //$item->getBrand()->name;
    }

    public function getItems()
    {
        return $this->hasMany('App\Models\ClientRecordItem', 'id', 'client_record_id');
    }

    public function getServices()
    {
        return $this->hasMany('App\Models\ClientRecordService', 'id', 'client_record_id');
    } 
}
