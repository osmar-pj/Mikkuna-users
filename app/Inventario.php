<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $guarded = [];

    public function item() {
        return $this->hasMany(ItemCarateristica::class, 'inventario_id');
    }
}
