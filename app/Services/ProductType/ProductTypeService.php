<?php


namespace App\Services\ProductType;


use App\Models\ProductType\ProductType;
use App\Repositories\ProductType\ProductTypeRepository;
use Illuminate\Support\Facades\DB;

class ProductTypeService
{

    private $repository;

    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->repository = $productTypeRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(){
        return $this->repository->all()->sortDesc();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllWithProducts()
    {
        return $this->repository->getWithProducts()->sortDesc();
    }

    /**
     * @param array $request
     * @return ProductType
     */
    public function insert(array $request)
    {
        $type = new ProductType($request);
        $this->repository->save($type);
        return $type;
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
