<?php
namespace App\Admin\Envs\Services;

use App\Admin\Envs\DTOs\EnvData;
use App\Install\Services\Update;

class Create extends Update
{
    public function execute(EnvData $data)
    {
        $this->envUpdate('STRIPE_KEY', $data->stripeKey);
        $this->envUpdate('STRIPE_SECRET', $data->stripeSecret);
        $this->envUpdate('MAIL_MAILER', $data->mailMailer);
        $this->envUpdate('MAIL_HOST', $data->mailHost);
        $this->envUpdate('MAIL_PORT', $data->mailPort);
        $this->envUpdate('MAIL_USERNAME', $data->mailUsername);
        $this->envUpdate('MAIL_PASSWORD', $data->mailPassword);
        $this->envUpdate('MAIL_ENCRYPTION', $data->mailEncryption);
        $this->envUpdate('MAIL_FROM_ADDRESS', $data->mailFromAddress);
        $this->envUpdate('APP_NAME', $data->appName);
        $this->envUpdate('APP_URL', $data->appUrl);
        $this->envUpdate('DB_CONNECTION', $data->dbConnection);
        $this->envUpdate('DB_HOST', $data->dbHost);
        $this->envUpdate('DB_PORT', $data->dbPort);
        $this->envUpdate('DB_DATABASE', $data->dbDatabase);
        $this->envUpdate('DB_USERNAME', $data->dbUsername);
        $this->envUpdate('DB_PASSWORD', $data->dbPassword);
    }
}