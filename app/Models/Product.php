<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price_1',
        'price_3',
        'price_5',
        'user_id',
    ];
 
    public function scopeFilter($query, array $filter) {
        // if($filter['tag'] ?? false) {
        //     $query->orWhere('tags', 'like', '%' . request('tag') . '%');
        // }

        // if($filter['search'] ?? false) {
        //     $query->orWhere('tags', 'like', '%' . request('search') . '%')
        //         ->orWhere('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('description', 'like', '%' . request('search') . '%')
        //         ->orWhere('company', 'like', '%' . request('search') . '%')
        //     ;
        // }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems(){
        return $this->hasMany(Order::class, 'product_id');
    }
}
