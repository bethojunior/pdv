<?php


namespace App\Models\ProductsTable;


use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class ProductsTable extends Model
{
    protected $table = 'products_table';
    protected $fillable = ['products_id','table','status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class,'id','products_id');
    }
}
