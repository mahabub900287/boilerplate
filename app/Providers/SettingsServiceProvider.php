<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function () {
            return new Settings();
        });
        $loader = AliasLoader::getInstance();
        $loader->alias('settings', Settings::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!App::runningInConsole() && count(Schema::getColumnListing('settings'))) {
            $setting = Settings::get();
            foreach ($setting as $value) {
                Config::set('settings.' . $value->settings_key, $value->settings_value);
            }
        }
    }
}
