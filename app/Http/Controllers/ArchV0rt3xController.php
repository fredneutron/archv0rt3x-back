<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ArchV0rt3xController extends Controller {

    public function __construct() {
        $this->user = User::with([
            'hobby',
            'project'
        ])->where('name', 'Babatunde Adelabu')->first();
    }
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

     public function hobbies(Request $request)
     {
        return $this->user->hobby->implode('name', ', ');
     }

     public function projects(Request $request)
     {
        //  return $this->user->project->with(['tools', 'type'])->get();  
         return Project::with(['tools', 'type'])->where('user_id', $this->user->id)->get();
     }
}