<?php


namespace App\Services\Sale;


use App\Constants\SaleConstants;
use App\Models\ProductsTable\ProductsTable;
use App\Models\Sale\Sale;
use App\Repositories\ProductsTable\ProductsTableRepository;
use App\Repositories\Sale\SaleRepository;
use App\Services\Cashier\CashierService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleService
{

    private $repository;
    private $productsTableRepository;
    private $cashierService;

    /**
     * SaleService constructor.
     * @param SaleRepository $saleRepository
     * @param ProductsTableRepository $productsTableRepository
     * @param CashierService $cashierService
     */
    public function __construct(SaleRepository $saleRepository , ProductsTableRepository $productsTableRepository, CashierService $cashierService)
    {
        $this->repository = $saleRepository;
        $this->cashierService = $cashierService;
        $this->productsTableRepository = $productsTableRepository;
    }

    /**
     * @param array $request
     * @return bool
     * @throws \Exception
     */
    public function insert(array $request)
    {
        try{
            $products = isset($request['product_id']) ? $request['product_id'] : null;

            $table = $this->repository->find($request['table']);
            $isTable = isset($table->table); // verifca se existe o atributo table da mesa, sem esse atributo qualquer retorno do find sempre será true
            /** Se a mesa existe, verifica o status  **/
            if($isTable === true){
                if($table->status === SaleConstants::CLOSED){
                    /** Reabrindo mesa **/
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
                    return true;
                }

                /** Verifica se mesa está aberta */
                if($table->status === SaleConstants::OPEN){
                    /** Adcionando produtos a mesa já aberta **/
                    foreach ($products as $product){
                        $productsTable = new ProductsTable([
                            'products_id' => $product,
                            'table' => $request['table'],
                            'status' => SaleConstants::OPEN
                        ]);
                        $saveProducts = $this->productsTableRepository->save($productsTable);
                    }
                    return false;
                }
            }

            /**
             * Criando nova mesa
             */
            if($isTable === false){
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
            throw $exception;
        }
    }

    /***
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll()
    {
        return $this->repository
            ->getAll()->sortByDesc();
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
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function updateStatus(array $request)
    {
        $id = $request['id'];
        $table = $this->repository->findTable($id);

        $this->cashierService
            ->create($request , $table);

        $table->update(['status' => SaleConstants::CLOSED]);

        $products = $this->productsTableRepository
            ->getAllByTable($table->table);

        foreach ($products as $product){
            $product->update(['status' => SaleConstants::CLOSED]);
        }

        return $products;
    }

}
