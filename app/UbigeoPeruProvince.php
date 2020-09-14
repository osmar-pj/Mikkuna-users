<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbigeoPeruProvince extends Model
{
    protected $guarded = [];

    public function department() {
        return $this->belongsTo(UbigeoPeruDepartment::class);
    }
}
