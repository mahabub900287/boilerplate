<?php

namespace App\Services\Utilities;

use App\Helpers\GlobalConstant;
use Exception;
use Intervention\Image\Facades\Image;

class FileUploadService
{
    public function uploadFile($file, $upload_path = null, $delete_path = null, $use_original_name = false, $add_time_to_name = true)
    {
        try {
            // Delete old file
            if ($delete_path) {
                $this->delete($delete_path);
            }
            // Upload new file
            return $this->upload($file, $upload_path, $use_original_name, $add_time_to_name);
        } catch (Exception $ex) {
            return null;
        }
    }

    public function upload($file, $path = 'others', $use_original_name = false, $add_time_to_name = true)
    {
        try {
            if (!$use_original_name) {
                $name = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            } else {
                $full_name = $file->getClientOriginalName();
                $extract_name = explode('.', $full_name);

                if ($add_time_to_name) {
                    $name = generate_slug($extract_name[0]) . '-' . time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                } else {
                    $name = generate_slug($extract_name[0]) . '.' . $file->getClientOriginalExtension();
                }
            }
            // Store image to public disk
            $file->storeAs($path, $name);

            return $name ?? '';
        } catch (\Exception $ex) {
            return '';
        }
    }

    public function uploadImage($image, string $image_name, $path = 'others')
    {
        try {
            $src_path = $image->storeAs($path, $image_name);

            return $src_path;
        } catch (\Exception $e) {
            log_error($e);
        }
    }

    /**
     * @param $src_path
     * @return void
     */
    public function generateThumb($image_path, $image)
    {
        try {
            // Create thumb
            $full_path = storage_path($image_path);
            // Convert image to thumb
            $img = Image::make($image);
            $img->resize(500, 400, function ($constraint) {
                // Maintain the aspect ratio
                $constraint->aspectRatio();
                // Prevent upscaling if the original image is smaller
                $constraint->upsize();
            });
            return $img->save($full_path);
        } catch (\Exception $e) {
            log_error($e);
        }
    }

    public function delete($path = '')
    {
        try {
            // Delete image form public directory
            $path = storage_path('app/public/' . $path);
            if (file_exists($path)) {
                unlink($path);
            }
        } catch (\Exception $ex) {
        }
    }
}
