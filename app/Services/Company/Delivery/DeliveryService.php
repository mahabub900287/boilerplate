<?php

namespace App\Services\Company\Delivery;

use Throwable;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Models\DeliveryProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DeliveryService extends BaseService
{
	protected $model;
	public function __construct(Delivery $model)
	{
		parent::__construct($model);
	}

	public function createOrUpdate($data, $id = null)
	{
		try {
			if ($id) {
				try {
					DB::beginTransaction();

					$data['updated_by'] = Auth::id();
					$data['delivery_metarial']=json_encode($data['delivery_metarial']);
					$attribute = $this->model->findOrFail($id)->update($data);
					// Upload attribute items
					if (isset($data['item_data'])) {
						// Delete old data
						DeliveryProduct::where('delivery_id', $id)->delete();
						// Upload new data
						foreach ($data['item_data'] as $item) {
							$attribute_item = new DeliveryProduct();
							$attribute_item->delivery_id = $id;
							$attribute_item->quantity = $item['quantity'];
							$attribute_item->tracking_number = $item['tracking_number'];
							$attribute_item->save();
						}
					}
					DB::commit();
					return $attribute;
				} catch (Throwable $th) {
					DB::rollback();
					throw $th;
				}
			} else {
				try {
					DB::beginTransaction();
					$data['created_by'] = Auth::id();
					$data['delivery_metarial'] = json_encode($data['delivery_metarial']);
					$attribute = $this->model::create($data);
					// Upload attribute items
					if (isset($data['item_data'])) {
						foreach ($data['item_data'] as $item) {
							$attribute_item = new DeliveryProduct();
							$attribute_item->delivery_id = $id;
							$attribute_item->quantity = $item['quantity'];
							$attribute_item->tracking_number = $item['tracking_number'];
							$attribute_item->save();
						}
					}
					DB::commit();
					return $attribute;
				} catch (Throwable $th) {
					DB::rollback();
					throw $th;
				}
			}
		} catch (Throwable $th) {
			throw $th;
		}
	}
	public function deleteItem($id)
	{
		try {
			// Delete delivery item
			$items = DeliveryProduct::where('delivery_id', $id)->get();
			foreach ($items as $item) {
				$item->delete();
			}
			// Delete delivery
			$data = $this->model::findOrFail($id);
			return $data->delete();
		} catch (Throwable $th) {
			throw $th;
		}
	}
}
