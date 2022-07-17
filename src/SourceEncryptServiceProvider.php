<?php
/**
 * Laravel Source Encryption.
 *
 * @author      The Departed / Mr Robot
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 *
 * @link        https://github.com/theDepart3d/laravel-source-encryption
 */

namespace thedeparted\LaravelSourceEncryption;

use Illuminate\Support\ServiceProvider;

class SourceEncryptServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register hard-delete-expired artisan command
        $this->commands([
            SourceEncryptCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $configPath = __DIR__.'/../config/source-encryption.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('source-encryption.php');
        } else {
            $publishPath = base_path('config/source-encryption.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }
}
