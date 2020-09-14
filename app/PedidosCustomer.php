<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidosCustomer extends Model
{
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function inventario() {
        return $this->belongsTo(Inventario::class);
    }

    public function precio_inventario() {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }
}
