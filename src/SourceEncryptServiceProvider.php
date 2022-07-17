<?php
/**
 * Laravel Source Encryption.
 *
 * @author      The Departed / Mr Robot
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 *
 * @link        https://git.saeedhurzuk.com/MrRobot/Laravel-Source-Encryption
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
        $consolePath = __DIR__.'/../app/Console/Commands/SourceEncryptionKey.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('source-encryption.php');
            $pubConfPath = base_path('/app/Console/Commands/SourceEncryptionKey.php');
        } else {
            $publishPath = base_path('config/source-encryption.php');
            $pubConfPath = base_path('/app/Console/Commands/SourceEncryptionKey.php');
        }
        $this->publishes([
            $configPath => $publishPath,
            $consolePath => $pubConfPath
        ], 'encryptionConfig');
    }
}
