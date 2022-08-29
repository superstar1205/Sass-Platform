<?php

namespace App\Install\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

class UsersController extends InstallController
{
    public function create()
    {
        $done = $this->isDone();

        if ($done) {
            return Redirect::route('install.done');
        }

        $completed = json_encode(['file', 'database', 'migration']);

        return view('install.users.create', compact('completed'));
    }

    private function isDone()
    {
        return User::query()->where('email', 'admin@formed.com')->count() > 0;
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

            Artisan::call('install');

            return Redirect::route('install.done');

        } catch (\Exception $exception) {

            return Redirect::back()->with('message', $exception->getMessage());
        }


    }

}
