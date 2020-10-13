<?php

namespace App\Models\Sale;

use App\Models\Product\Product;
use App\Models\ProductsTable\ProductsTable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['table','status','user_id','products_table_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(ProductsTable::class,'table','products_table_id');
    }


}
