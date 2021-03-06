<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Parcel extends Model
{
    protected $table = 'tb_parcels';
    protected $fillable = ['status', 'date', 'payment_method_id', 'client_record_id', 'value', 'number', 'parcel_number'];
    protected $primaryKey = 'id';

    public function getMethod()
    {
        return $this->hasOne('App\Models\PaymentMethod', 'id', 'payment_method_id');
    }

    public function getRecord()
    {
        return $this->hasOne('App\Models\ClientRecord', 'id', 'client_record_id');
    }

    public function getDateFormattedAttribute()
    {
        if($this->date == null){
            return "";
        } else {
            return Carbon::createFromFormat('Y-m-d', $this->date)->format('d/m/Y');
        }  
    }

}


