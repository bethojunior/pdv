<?php


namespace App\Models\Cashier;


use App\Models\ProductsCashier\ProductsCashier;
use App\Models\ProductsTable\ProductsTable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $table = 'cashier';
    protected $fillable = ['user_id','value','table','sales_id'];

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
        return $this->hasMany(ProductsCashier::class,'sale_id','table');
    }


}
