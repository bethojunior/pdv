<?php


namespace App\Models\Cashier;


use App\Models\ProductsTable\ProductsTable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $table = 'cashier';
    protected $fillable = ['user_id','value','table'];

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