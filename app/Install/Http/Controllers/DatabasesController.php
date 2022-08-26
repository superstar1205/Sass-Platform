<?php

namespace App\Install\Http\Controllers;

use App\Install\Services\Update;
use App\Models\Installer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DatabasesController extends InstallController
{
    public function create()
    {
        $done = $this->isDone();

        if ($done) {
            return Redirect::route('install.migrations.create');
        }

        $completed = json_encode(['file']);


        return view('install.databases.create', compact('completed'));
    }

    private function isDone()
    {
        return !empty(config('database.connections.mysql.username'));
    }

    public function store(Request $request, Update $update)
    {
        $host = $request->get('host');
        $port = $request->get('port');
        $database = $request->get('database');
        $username = $request->get('username');
        $password = $request->get('password');

        if (!(new Installer())->databaseCanConnect(
            $host,
            $port,
            $database,
            $username,
            $password,
        )) {
            return Redirect::back()->with('message', 'There was an error with the database connection');
        }

        $update->updateDbCredentials(
            $host,
            $port,
            $database,
            $username,
            $password,
        );

        return Redirect::route('install.migrations.create');
    }
}
