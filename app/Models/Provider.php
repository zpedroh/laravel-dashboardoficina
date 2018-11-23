<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'tb_providers';
    protected $fillable = ['name', 'cnpj', 'telephone'];
    protected $primaryKey = 'id';

    public function getAdress()
    {
        return $this->hasOne('App\Models\Adress', 'provider_id', 'id');
    }

    public function getPItems()
    {
        return $this->hasMany('App\Models\ProviderItem', 'provider_id', 'id');
    }
}
