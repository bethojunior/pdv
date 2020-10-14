<?php


namespace App\Services\Sale;


use App\Constants\SaleConstants;
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

            $table = $this->repository->find($request['table']);


            if(isset($table)){
                if($table->status == SaleConstants::CLOSED){
                    $that = $this->repository->find($table->id);
                    $that->update(['status' => SaleConstants::OPEN]);
                    if(isset($products)){
                        foreach ($products as $product){
                            $productsTable = new ProductsTable([
                                'products_id' => $product,
                                'table' => $request['table'],
                                'status' => SaleConstants::OPEN
                            ]);
                            $saveProducts = $this->productsTableRepository->save($productsTable);
                        }
                    }
                    if($saveProducts){
                        $user = Auth::user();
                        $request['products_table_id'] = $productsTable->table;
                        $request['status'] = 'open';
                        $request['user_id'] = $user->id;
                        $sale = new Sale($request);
                        $this->repository->update($sale);
                    }
                }

                if($table->status == SaleConstants::OPEN){
                    foreach ($products as $product){
                        $productsTable = new ProductsTable([
                            'products_id' => $product,
                            'table' => $request['table'],
                            'status' => SaleConstants::OPEN
                        ]);
                        $saveProducts = $this->productsTableRepository->save($productsTable);
                    }
                }
            }

            if(!isset($table)){
                if(isset($products)){
                    foreach ($products as $product){
                        $productsTable = new ProductsTable([
                            'products_id' => $product,
                            'table' => $request['table'],
                            'status' => SaleConstants::OPEN
                        ]);
                        $saveProducts = $this->productsTableRepository->save($productsTable);
                    }

                    $that = $this->productsTableRepository->find($productsTable->id);

                    $user = Auth::user();

                    $data = [
                        'products_table_id' => $that->table,
                        'status' => SaleConstants::OPEN,
                        'user_id' => $user->id,
                        'table'   => $request['table']
                    ];

                    $sale = new Sale($data);

                    $this->repository->save($sale);
                }

            }



        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return true;
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
    public function getAllByStatus($status = SaleConstants::OPEN)
    {
        return $this->repository
            ->getAllByStatus($status);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function updateStatus($id)
    {

        $table = $this->repository->find($id);

        $table->update(['status' => SaleConstants::CLOSED]);

        $products = $this->productsTableRepository
            ->getAllByTable($table->table);

        foreach ($products as $product){
            $product->update(['status' => SaleConstants::CLOSED]);
        }

        return $products;
    }

}
