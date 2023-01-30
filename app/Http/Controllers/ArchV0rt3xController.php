<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;

class ArchV0rt3xController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = $this->detailsByName();
    }

    public function biography()
    {
        $bio = $this->user->bio;

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

    public function education()
    {
        return $this->user->education;
    }

    public function hobbies()
    {
        return $this->user->hobby->implode('name', ', ');
    }

    public function mail(Request $request)
    {
        $data = $request->all();
        if (!empty($data['name']) && !empty($data['subject']) && !empty($data['email']) && !empty($data['message'])) {
            $clientName = $data['name'];
            $clientSubject = $data['subject'];
            $clientEmail = $data['email'];
            $clientMessage = $data['message'];
            // send response to client
            $client = $this->sendMail('email.client', [
                'view' => [
                    'name' => $clientName,
                    'subject' => $clientSubject
                ],
                'sender' => [
                    'name' => config('app.name'),
                    'email' => $this->user->bio->email
                ],
                'client' => [
                    'name' => $clientName,
                    'email' => $clientEmail,
                    'subject' => $clientSubject
                ]
            ]);

            if ($client) {
                // send client mail to Admin
                $admin = $this->sendMail('email.Admin', [
                    'view' => [
                        'name' => $clientName,
                        'email' => $clientEmail,
                        'subject' => $clientSubject,
                        'message' => $clientMessage,
                        'reply' => "mailto:".$clientEmail."?subject=RE: ".$clientSubject."&body=Hi ".$clientName.", "
                    ],
                    'client' => [
                        'name' => config('app.name'),
                        'email' => $this->user->bio->email,
                        'subject' => $clientSubject
                    ],
                    'sender' => [
                        'name' => $clientName,
                        'email' => $clientEmail
                    ]
                ]);

                if ($admin) {
                    return response()->json([
                        'code' => 'Well done!',
                        'message' => ' Message send successfully.'
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Error: Please try again later.'
                    ], 400);
                }
            }
        } else {
            return response()->json([
                'message' => 'Error: required data can not be empty.'
            ], 400);
        }
    }

    public function profession()
    {
        return $this->user->profession->pluck('name')->all();
    }

    public function projects()
    {
        return Project::with(['tools', 'type'])->where('user_id', $this->user->id)->get();
    }

    public function skill()
    {
        return $this->user->skill->mapToGroups(function ($skill, $key) {
            return [$skill['type'] => $skill['name']];
        })->all();
    }

    public function socials()
    {
        return $this->user->social->map(function ($social) {
            return ['name' => $social->name, 'url' => $social->url];
        })->all();
    }

    public function work()
    {
        return $this->user->work->sortByDesc('start_on')->values()->all();
    }

    private function detailsByName()
    {
        return User::with([
            'bio',
            'education',
            'hobby',
            'profession',
            'skill',
            'social',
            'work'
        ])->where('name', 'Babatunde Adelabu')->first();
    }

    private function sendMail(String $mail_view, Array $data)
    {
        $sender = $data['sender'];
        $client = $data['client'];
        // declare mail class to use
        $beautymail = app()->make(Beautymail::class);
        // send mail
        $result = $beautymail->send($mail_view, $data['view'], function ($message) use($sender, $client) {
            $message->from($sender['email'], $sender['name'])
                ->to($client['email'], $client['name'])
                ->subject($client['subject']);
        });
        return $result;
    }
}
