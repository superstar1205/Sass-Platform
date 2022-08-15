<?php
namespace App\Admin\Envs\DTOs;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class EnvData extends DataTransferObject
{
    public ?string $stripeKey;

    public ?string $stripeSecret;

    public ?string $appName;

    public ?string $appUrl;

    public ?string $dbConnection;

    public ?string $dbHost;

    public ?string $dbPort;

    public ?string $dbDatabase;

    public ?string $dbUsername;

    public ?string $dbPassword;

    public ?string $mailMailer;

    public ?string $mailHost;

    public ?string $mailPort;

    public ?string $mailUsername;

    public ?string $mailPassword;

    public ?string $mailEncryption;

    public ?string $mailFromAddress;


    public static function fromRequest(Request $request): self
    {
        return new self([
            'stripeKey' => $request->post('stripe_key'),
            'stripeSecret' => $request->post('stripe_secret'),
            'appName' => $request->post('app_name'),
            'appUrl' => $request->post('app_url'),
            'dbConnection' => $request->post('db_connection'),
            'dbHost' => $request->post('db_host'),
            'dbPort' => $request->post('db_port'),
            'dbDatabase' => $request->post('db_database'),
            'dbUsername' => $request->post('db_username'),
            'dbPassword' => $request->post('db_password'),
            'mailMailer' => $request->post('mail_mailer'),
            'mailHost' => $request->post('mail_host'),
            'mailPort' => $request->post('mail_port'),
            'mailUsername' => $request->post('mail_username'),
            'mailPassword' => $request->post('mail_password'),
            'mailEncryption' => $request->post('mail_encryption'),
            'mailFromAddress' => $request->post('mail_from_address'),
        ]);
    }
}