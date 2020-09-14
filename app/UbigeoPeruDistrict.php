<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbigeoPeruDistrict extends Model
{
    protected $guarded = [];

    public function province() {
        return $this->belongsTo(UbigeoPeruProvince::class);
    }

    public function department() {
        return $this->belongsTo(UbigeoPeruDepartment::class);
    }
}
