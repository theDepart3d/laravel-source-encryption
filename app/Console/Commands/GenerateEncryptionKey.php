<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateEncryptionKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:encryptionKey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Custom Source Encryption Key';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path('.env');
        $keyLength = env('SOURCE_ENCRYPTION_LENGTH', 16);
        $token = bin2hex(openssl_random_pseudo_bytes($keyLength));
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'SOURCE_ENCRYPTION_KEY=' . env('SOURCE_ENCRYPTION_KEY'), 'SOURCE_ENCRYPTION_KEY='. $token, file_get_contents($path)
            ));
        }
    }
}
