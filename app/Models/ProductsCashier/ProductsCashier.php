<?php

namespace App\Models\ProductsCashier;

use App\Models\Product\Product;
use App\Models\ProductType\ProductType;
use Illuminate\Database\Eloquent\Model;

class ProductsCashier extends Model
{
    protected $table = 'products_cashier';
    protected $fillable = ['product_id','sale_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

}
