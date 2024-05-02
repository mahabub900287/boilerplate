<?php

namespace App\Services\Company\Product;

use App\Models\Bundle;
use Illuminate\Support\Str;
use App\Services\BaseService;

class BundleService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = Bundle::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            $data['sku'] = Str::replace(' ', '', $data['sku']);
            $data['status'] = 'active';
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
