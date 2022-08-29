<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;
use PDOException;
use Swift_SmtpTransport;
use Swift_TransportException;

class Installer extends Model
{
    use HasFactory;

    public function envFileExists($envName = '.env'): bool
    {
        return file_exists(base_path($envName));
    }

    public function databaseCanConnect($host, $port, $database, $username, $password): bool
    {
        try {
            $connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }



}
