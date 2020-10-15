<?php

namespace App\Models\ProductsCashier;

use App\Models\Product\Product;
use App\Models\ProductType\ProductType;
use Illuminate\Database\Eloquent\Model;

class ProductsCashier extends Model
{
    protected $fillable = ['product_id','sale_id'];


}
