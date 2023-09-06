<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'imgpath', 'name', 'category', 'price', 'description', 'quantity'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['category'] ?? false) {
            $category = Category::where('category', 'like', '%' . $filters['category'] . '%')->first();
            if ($category) {
                $query->where('category', $category->id);
            } else {
                // If no category is found, return an empty result
                $query->where('category', null);
            }
        }

        if ($filters['search'] ?? false) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        }
    }
}
