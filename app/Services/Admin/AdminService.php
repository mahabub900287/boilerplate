<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\BaseService;
use App\Services\Utilities\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminService extends BaseService
{
    protected $model;

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->model = User::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            $role_id = request()->input('role');
            // Upload image
            if (isset($data['avatar']) && $data['avatar'] != null) {
                if ($id) {
                    $item = $this->get($id);
                    if (!is_null($item->avatar)) {
                        // Remove file
                        remove_old_image('user/' . $item->avatar);
                    }
                    // Upload avatar to storage
                    $src_path = $this->fileUploadService->uploadFile($data['avatar'], 'user', true);
                    // Store avatar name to data
                    $data['avatar'] = $src_path;
                } else {
                    // Upload avatar to storage
                    $src_path = $this->fileUploadService->uploadFile($data['avatar'], 'user', true);
                    // Store avatar name to data
                    $data['avatar'] = $src_path;
                }
            } else {
                unset($data['avatar']);
            }
            if ($data['password'] !== null) {
                $data['password'] = Hash::make($data['password']);
                $user = parent::storeOrUpdate($data, $id);
            } else {
                $value = Arr::except($data, ['password', 'password']);
                $user = parent::storeOrUpdate($value, $id);
            }
            if ($id == null) {
                $user->assignRole((int)$role_id);
            } else {
                $user = $this->model::find($id);
                $user->syncRoles((int)$role_id);
            }
            return $user;
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
