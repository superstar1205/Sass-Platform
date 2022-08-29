<?php

namespace App\Install\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class MigrationsController extends InstallController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $done = $this->isDone();

        if ($done) {
            return Redirect::route('install.users.create');
        }

        $completed = json_encode(['file','database']);

        return view('install.migrations.create', compact('completed'));
    }

    private function isDone()
    {
        return Schema::hasTable('users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Artisan::call('migrate', ['--force' => true]);

            return Redirect::route('install.users.create');

        } catch (\Exception $exception) {

            return Redirect::back()->with('message', $exception->getMessage());
        }



    }

}
