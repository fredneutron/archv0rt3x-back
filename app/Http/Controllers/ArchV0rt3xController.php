<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class ArchV0rt3x extends Controller {

    public function __construct() {
        $this->user = User::where('name', 'Babatunde Adelabu');
    }
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

     public function show()
     {
         $user = User::where('name', 'Babatunde Adelabu');
     }
}