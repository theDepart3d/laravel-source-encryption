<?php
$keyLength = 16;
// to enable app encryption key usage
// php artisan make:encryptionKey or
// set SOURCE_ENCRYPTION_KEY='yourcustomstrongkey' in your .env file 
if (env('SOURCE_ENCRYPTION_KEY') === '') {
    $key = bin2hex(random_bytes($keyLength));
} else {
    $key = env('SOURCE_ENCRYPTION_KEY');
}
return [
    'source'      => ['app', 'database', 'routes', 'config'], // Path(s) to encrypt
    'destination' => 'encrypted-source', // Destination path
    'key' => $key, // custom key
    'key_length'  => $keyLength, // Encryption key length
];
