<?php

namespace App\Services;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    public function updateOrStoreSettings(Request $requestSettings)
    {
        try {
            $requestData = $requestSettings->except('_token');
            foreach ($requestData as $key => $value) {
                if (! empty($value)) {

                    Settings::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            }
            Cache::flush();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSettings($key)
    {
        $expire = \Carbon\Carbon::now()->addMinutes(30);
        $settings = Cache::remember('settings-'.$key, $expire, function () use ($key) {
            return Settings::where('key', $key)->first();
        });

        return $settings ? $settings->value : false;
    }
}
