<?php

namespace App;

use App\Transaction;
use App\Seller;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const AVAILABLE = "available";
    const UNAVAILABLE = "unavailable";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "name",
        "description",
        "quantity",
        "price",
        "image",
        "seller_id",
        "status"
    ];

    protected $hidden = [
        'pivot'
    ];
    
    public function isAvailable() {
        return $this->status == Product::AVAILABLE;
    }

    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
