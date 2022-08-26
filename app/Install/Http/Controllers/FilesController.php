<?php

namespace App\Install\Http\Controllers;

use App\Models\Installer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FilesController extends InstallController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $done = (new Installer)->envFileExists();
        $completed = json_encode([]);
        $current = 'file';

        if ($done) {
            return Redirect::route('install.databases.create');
        }

        return view('install.files.create', compact('current','completed'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

}
