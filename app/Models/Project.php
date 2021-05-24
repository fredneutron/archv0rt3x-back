<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use \App\Models\AppType;
use \App\Models\Skill;
use \App\Models\User;

class Project extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'project';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Project $model) {
            Storage::disk(env('Disk'))->delete(self::find($model->id)->image);
        });

        static::deleting(function (Project $model) {
            Storage::disk(env('Disk'))->delete(self::find($model->id)->image);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Babatunde Adelabu',
        ]);
    }

    public function type()
    {
        return $this->hasOne(AppType::class);
    }

    public function tools()
    {
        return $this->hasMany(Skill::class)
            ->where('type', 'hard');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $destination_path = '/images/projects/';

        // if the image was erased
        // if($value == null){
        //     // delete the image from cloud
        //     Cloudder::destoryImage(Cloudder::getPublicId());
        //     Cloudder::delete(Cloudder::getPublicId());
        // }

        // // if a base64 was sent, store it in the db
        // if (starts_with($value, 'data:image'))
        // {
        //     // Generate a public_id
        //     $public_id = md5($value.time());

        //     // upload the image to Cloudinary
        //     Cloudder::upload($value,null, ['folder' => $destination_path, 'public_id' => $public_id]);

        //     // get image url from cloudinary
        //     //$image_url = Cloudder::secureShow(Cloudder::getPublicId());
	    //     $image_url = Cloudder::secureShow(Cloudder::getPublicId(), ['width'=> 'auto', 'height' => 1200, 'crop'=> 'fit']);

        //     // Save the path to the database
        //     $this->attributes[$attribute_name] = $image_url;
        // }


            // local storage image upload
       // if the image was erased
       if ($value == null){
           // delete the image from disk
           Storage::disk(env('Disk'))->delete($this->{$attribute_name});

           // set null in the database column
           $this->attributes[$attribute_name] = null;
       }

       // if a base64 was sent, store it in the db
       if (Str::startsWith($value, 'data:image'))
       {
           // Make the image
           $image = Image::make($value);

           // Generate a filename
           $filename = $destination_path . md5($value.time()).'.jpg';

           // Store the image on the disk.
           Storage::disk(env('Disk'))->put($filename, $image->stream());

           // Save the path to the database
           $this->attributes[$attribute_name] = $filename;
       }
    }

    // public function setTools($value)
    // {
    //     // convert to string and save to the database
    //     $this->attributes[$attribute_name] = implode(', ', $value);
    // }
}
