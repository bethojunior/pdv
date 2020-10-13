<?php


namespace App\Services\Product;


use App\Models\Product\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{

    private $repository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getAll(){
        return $this->repository->getAll();
    }

    /**
     * @param array $request
     * @return Product
     */
    public function insert(array $request)
    {
        $product = new Product($request);
        $this->repository->save($product);
        return $product;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $result = $this->repository->find($id);
            $result->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return $result;
    }

}
