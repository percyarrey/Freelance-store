<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id','order_id', 'name', 'email', 'phone', 'address', 'user_id','product_id', 'quantity','amount','status'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['status'] ?? false) {
            $status = '%' . $filters['status'] . '%';
            $query->where(function ($query) use ($status) {
                $query->where('status', 'like', $status);
            });
        }
    }
}
