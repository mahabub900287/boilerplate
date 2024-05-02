<?php

namespace App\Services\Company\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\BaseService;

class ProductService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = Product::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            isset($data['prepacked']) ? $data['prepacked'] = 1 : $data['prepacked'] = 0;
            $data['sku'] = Str::replace(' ', '', $data['sku']);
            $data['status'] = 'active';
            if ($data['prepacked'] == 1) {
                $data['prepacked_metarial'] = json_encode([
                    'length' => $data['pre_length'],
                    'width'  => $data['pre_width'],
                    'height' => $data['pre_height']
                ]);
            }
            if ($data['prepacked'] == 0) {
                $data['prepacked_metarial'] = null;
            }

            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
