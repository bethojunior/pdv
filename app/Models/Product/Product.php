<?php

namespace App\Models\Product;

use App\Models\ProductType\ProductType;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','product_types_id','description','value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type()
    {
        return $this->hasMany(ProductType::class,'id','product_types_id');
    }

}
