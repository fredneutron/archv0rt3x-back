<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\Education;
use App\Models\Hobby;
use App\Models\Profession;
use App\Models\Skill;
use App\Models\Social;
use App\Models\Work;
use App\Models\Bio;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bio() {
        return $this->hasOne(Bio::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function hobby()
    {
        return $this->hasMany(Hobby::class);
    }

    public function profession()
    {
        return $this->hasMany(Profession::class);
    }

    public function skill()
    {
        return $this->hasMany(Skill::class);
    }

    public function social()
    {
        return $this->hasMany(Social::class);
    }

    public function work()
    {
        return $this->hasMany(Work::class);
    }
}
