<?php

namespace App\Install\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class InstallController extends Controller
{
    public function index()
    {
        return Redirect::route('install.databases.create');
    }

    private function isStarted()
    {
        return !empty(config('database.connections.mysql.username'));
    }

    public function done()
    {
        $done = $this->isStarted();

        if (!$done) {
            return Redirect::route('install.databases.create');
        }

        $completed = json_encode(['file', 'database', 'migration', 'user']);
        $current = 'done';
        return view('install.done', compact('current', 'completed'));
    }
}
