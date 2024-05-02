<?php

namespace App\Services\Company\Product;

use App\Models\BundleProduct;
use Illuminate\Support\Str;
use App\Services\BaseService;

class BundleProductService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = BundleProduct::class;
    }

    public function storeOrUpdate($data, $bundleId = null, $id = null)
    {
        try {
            $this->model::where('bundle_id', $id)->delete();
            $data['products'] = array_combine($data['products'], $data['quantity']);
            foreach ($data['products'] as $key => $item) {
                $bundle_product['product_id'] = $key;
                $bundle_product['bundle_id'] = $bundleId;
                $bundle_product['quantity'] = $item;
                // If contain id update data or create new data
                if ($id) {
                    $this->model::insert($bundle_product);
                } else {
                    $this->model::insert($bundle_product);
                }
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
