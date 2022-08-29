<?php
namespace App\Install\Services;

use Illuminate\Support\Facades\Artisan;

class Update
{
    public function envUpdate($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $content = file_get_contents($path);
            $content = str_replace("=null", "=", $content);

            file_put_contents($path, str_replace(
                $key.'='.env($key), $key.'='.$value, $content
            ));
        }
        Artisan::call("config:clear");
    }

    public function updateDbCredentials($host, $port, $database, $username, $password)
    {
        $this->envUpdate('DB_HOST', $host);
        $this->envUpdate('DB_PORT', $port);
        $this->envUpdate('DB_DATABASE', $database);
        $this->envUpdate('DB_USERNAME', $username);
        $this->envUpdate('DB_PASSWORD', $password);
    }
}