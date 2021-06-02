<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ArchV0rt3xController extends Controller
{

    public function __construct()
    {
        $this->user = User::with([
            'education',
            'hobby',
            'social',
            'work'
        ])->where('name', 'Babatunde Adelabu')->first();
    }

    public function biography(Request $request)
    {
        return Bio::where(['first_name' => 'Babatunde', 'last_name' => 'Adelabu'])->first();
    }

    public function education(Request $request)
    {
        return $this->user->education;
    }

    public function hobbies(Request $request)
    {
        return $this->user->hobby->implode('name', ', ');
    }

    public function projects(Request $request)
    {
        return Project::with(['tools', 'type'])->where('user_id', $this->user->id)->get();
    }

    public function socials(Request $request)
    {
        return $this->user->social->map(function ($social) {
            return ['name' => $social->name, 'url' => $social->url];
        })->all();
    }

    public function work(Request $request)
    {
        return $this->user->work;
    }
}
