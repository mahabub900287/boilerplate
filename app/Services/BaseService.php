<?php

namespace App\Services;

use App\Helpers\GlobalConstant;
use File;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  null  $id
     * @return Builder|Builder[]|Collection|Model|void|null
     */
    public function get($id = null, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // If contain id return single data or return collection
            if ($id) {
                return $query->findOrFail($id);
            } else {
                return $query->get();
            }
        } catch (\Exception $e) {
            $notify[] = ['error', 'Something is Wrong'];

            return redirect()->back()->withNotify($notify);
        }
    }

    /**
     * @param  null  $id
     * @return void
     */
    public function storeOrUpdate(array $data, $id = null)
    {
        // try {
        // If contain id update data or create new data
        if ($id) {
            return $this->model::findOrFail($id)->update($data);
        } else {
            return $this->model::create($data);
        }
        // } catch (\Exception $e) {

        //     $notify[] = ['error', 'Something is Wrong'];
        //     return redirect()->back()->withNotify($notify);
        // }
    }

    /**
     * @return mixed|void
     */
    public function delete($id, bool $own_data = false)
    {
        try {
            $query = $this->model::query();
            $query->where('id', $id);
            // If contain id update data or create new data
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }

            return $query->first()->delete();
        } catch (\Exception $e) {
            $notify[] = ['error', 'Something is Wrong'];

            return redirect()->back()->withNotify($notify);
        }
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function logFlashThrow(\Exception $e)
    {
        $notify[] = ['error', 'Something is Wrong'];

        return redirect()->back()->withNotify($notify);
        throw $e;
    }

    public function deleteWithFile($id, bool $own_data = true, bool $contain_thumb = false)
    {
        try {
            $item = $this->get($id, [], $own_data);
            // Unlink
            try {
                // Remove file
                $image_path = storage_path('app/public/'.$this->model::FILE_STORE_PATH.'/'.$item->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                // Remove thumb file
                if ($contain_thumb) {
                    $thumb_path = storage_path('app/public/'.$this->model::FILE_STORE_THUMB_PATH.'/'.$item->image);
                    if (file_exists($thumb_path)) {
                        unlink($thumb_path);
                    }
                }
            } catch (\Exception $e) {
                log_error($e);
            }

            return $item->delete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @return void
     */
    public function getActiveData($id = null, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // If contain id return single data or return collection
            if ($id) {
                return $query->active()->findOrFail($id);
            } else {
                return $query->active()->get();
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @return LengthAwarePaginator|void
     */
    public function getPaginated(int $limit = GlobalConstant::DEFAULT_PER_PAGE, array $with = [], bool $own_data = false, string $sort = null, string $sort_by = 'DESC')
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // Sort data
            if ($sort) {
                $query->orderBy($sort, $sort_by);
            }

            return $query->paginate($limit);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @return void
     *
     * @throws \Exception
     */
    public function getPaginatedActive(int $limit = GlobalConstant::DEFAULT_PER_PAGE, array $with = [], bool $own_data = false, string $sort = null, string $sort_by = 'DESC')
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // Sort data
            if ($sort) {
                $query->orderBy($sort, $sort_by);
            }

            return $query->active()->paginate($limit);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $src_path
     * @return void
     */
    public function uploadThumb($image, $image_name)
    {
        try {
            // Create path
            $full_path = $this->model::FILE_STORE_PATH.'/'.$image_name;

            // Set thumb height & width
            $height = $this->model::THUMB_HEIGHT ?? GlobalConstant::DEFAULT_THUMB_HEIGHT;
            $width = $this->model::THUMB_WIDTH ?? GlobalConstant::DEFAULT_THUMB_WIDTH;
            // Convert image to thumb
            $img = Image::make($image);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path = Storage::put($full_path, $img->encode());

            return $path;
        } catch (\Exception $e) {
            log_error($e);
        }
    }
    public function uploadImaageResize($image, $image_name ,$path_name ,$height ,$width)
    {
        try {
            // Create path
            $full_path = $path_name.'/'.$image_name;
            // Convert image to thumb
            $img = Image::make($image);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path = Storage::put($full_path, $img->encode());

            return $path;
        } catch (\Exception $e) {
            log_error($e);
        }
    }
}
