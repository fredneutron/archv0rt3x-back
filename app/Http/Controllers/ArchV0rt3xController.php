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
            'profession',
            'skill',
            'social',
            'work'
        ])->where('name', 'Babatunde Adelabu')->first();
    }

    public function biography(Request $request)
    {
        $bio = Bio::where(['first_name' => 'Babatunde', 'last_name' => 'Adelabu'])->first();

        return collect([
            'name' => $bio->first_name.' '.$bio->last_name,
            'fullName' => $bio->first_name.' '.$bio->other_name.' '.$bio->last_name,
            'objective' => $bio->objective,
            'residential_address' => $bio->residential_address,
            'current_location' => $bio->current_location,
            'image' => $bio->profile_picture,
            'email' => $bio->email,
            'phone_number' => $bio->phone_number
        ]);
    }

    public function education(Request $request)
    {
        return $this->user->education;
    }

    public function hobbies(Request $request)
    {
        return $this->user->hobby->implode('name', ', ');
    }

    public function mail(Request $request)
    {
        // $request = $request->all();
        return [ 'name' => $request->name]; 
    }

    public function profession(Request $request)
    {
        return $this->user->profession->pluck('name')->all();
    }

    public function projects(Request $request)
    {
        return Project::with(['tools', 'type'])->where('user_id', $this->user->id)->get();
    }

    public function skill(Request $request)
    {
        return $this->user->skill->mapToGroups(function ($skill, $key) {
            return [$skill['type'] => $skill['name']];
        })->all();
    }

    public function socials(Request $request)
    {
        return $this->user->social->map(function ($social) {
            return ['name' => $social->name, 'url' => $social->url];
        })->all();
    }

    public function work(Request $request)
    {
        return $this->user->work->sortByDesc('start_on')->values()->all();
    }
}
