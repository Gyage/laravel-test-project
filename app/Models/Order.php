<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_finished',
        'total',
    ];

    public function scopeOwn($query, array $filter) {
        $filters = [
            ['orders.user_id', '=', $filter['id']]
        ];

        if($filter['newest'] ?? false) {
            $filters[] = ['is_finished', '=', false];
        }

        $query->where($filters)  
            ->with('orderitems')
            ->with('orderitems.product')
        ;
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
