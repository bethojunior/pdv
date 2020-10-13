<?php


namespace App\Services\Sale;


use App\Models\ProductsTable\ProductsTable;
use App\Models\Sale\Sale;
use App\Repositories\ProductsTable\ProductsTableRepository;
use App\Repositories\Sale\SaleRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleService
{

    private $repository;
    private $productsTableRepository;

    /**
     * SaleService constructor.
     * @param SaleRepository $saleRepository
     * @param ProductsTableRepository $productsTableRepository
     */
    public function __construct(SaleRepository $saleRepository , ProductsTableRepository $productsTableRepository)
    {
        $this->repository = $saleRepository;
        $this->productsTableRepository = $productsTableRepository;
    }

    /**
     * @param array $request
     * @return Sale|bool
     * @throws \Exception
     */
    public function insert(array $request)
    {
        try{
            $products = isset($request['product_id']) ? $request['product_id'] : null;

            if(isset($products)){
                foreach ($products as $product){
                    $productsTable = new ProductsTable([
                        'products_id' => $product,
                        'table' => $request['table'],
                        'status' => 'open'
                    ]);
                    $saveProducts = $this->productsTableRepository->save($productsTable);
                }
            }
            $table = $this->repository->find($productsTable->table);

            if(isset($table)){
                return true;
            }

            if($saveProducts){
                $user = Auth::user();
                $request['products_table_id'] = $productsTable->table;
                $request['status'] = 'open';
                $request['user_id'] = $user->id;
                $sale = new Sale($request);
                $this->repository->save($sale);
            }


        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return $sale;
    }

    /***
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll()
    {
        return $this->repository
            ->getAll();
    }

    /**
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByStatus($status = 'open')
    {
        return $this->repository
            ->getAllByStatus($status);
    }


}
