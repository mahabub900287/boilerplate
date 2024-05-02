<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Utilities\FileUploadService;

class SettingsController extends Controller
{
    public const FILE_STORE_PATH = 'settings';
    protected $fileUploadService;
    public function __construct()
    {
        $this->fileUploadService = app(FileUploadService::class);

        // $this->middleware(['permission:Site Settings'])->only(['edit']);
    }


    public function index()
    {
        $settings = [];
        $raw_settings = Settings::all();
        foreach ($raw_settings as $s) {
            $settings[$s->settings_key] = $s->settings_value;
        }

        setbreadcumb("System Settings");

        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request)
    {

        $data = $request->except('_token');
        if (isset($data['general'])) {
            // Set site logo
            $data = $this->uploadImage($data, 'system_logo');
            $data = $this->uploadImage($data, 'system_short_logo');
            // Set favicon
            $data = $this->uploadImage($data, 'favicon');
        }
        if (isset($data['mail_settings'])) {
            $media = $data['mail_settings'];
            $this->mideaConfig($media);
        }
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $settings = Settings::where('settings_key', $key)->first();
            if (!$settings) $settings = new Settings();
            $settings->settings_key = $key;
            $settings->settings_value = $data[$key];
            $settings->save();
        }
        $notify[] = ['success', 'System settings updated successfully'];
        return redirect()->back()->withNotify($notify);
    }


    /**
     * uploadImage
     *
     * @param  mixed $data
     * @param  mixed $field
     * @return void
     */
    public function uploadImage($data, $field)
    {
        // Get general settings
        $general = Settings::where('settings_key', 'general')->first();
        // Upload image
        if (isset($data['general'][$field])) {
            if (isset($general['settings_value'][$field]) && $general['settings_value'][$field] != null) {
                $array = explode('/', $general['settings_value'][$field]);
                $this->fileUploadService->delete('settings/' . $array[count($array) - 1]);
            }
            $this->fileUploadService->delete($data['general'][$field], self::FILE_STORE_PATH);
            $name = $this->fileUploadService->upload($data['general'][$field], self::FILE_STORE_PATH);
            $data['general'][$field] = get_storage_image(self::FILE_STORE_PATH, $name);
        } else {
            if (isset($general->settings_value[$field])) {
                $data['general'][$field] = $general->settings_value[$field];
            }
        }

        return $data;
    }
    public function mideaConfig($media)
    {

        try {
            $this->setEnv('MAIL_MAILER', $media['mailer']);
            $this->setEnv('MAIL_HOST', $media['host']);
            $this->setEnv('MAIL_PORT', $media['port']);
            $this->setEnv('MAIL_USERNAME', $media['username']);
            $this->setEnv('MAIL_PASSWORD', $media['password']);
            $this->setEnv('MAIL_ENCRYPTION', $media['encryption']);
            $this->setEnv('MAIL_FROM_ADDRESS', $media['from_address']);
            $this->setEnv('MAIL_FROM_NAME', $media['from_name']);
        } catch (\Throwable $e) {
            // 
        }
    }
    private function setEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
}
