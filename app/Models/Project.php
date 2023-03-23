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
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            $image = self::find($model->id)->image;
            if (env('IMAGE_UPLOAD') == 'local') {
                Storage::disk(env('Disk'))->delete($image);
            } else if (env('IMAGE_UPLOAD') == "cloudinary") {
                Cloudinary::destroy($image);
            }
        });

        static::deleting(function (Project $model) {
            $image = self::find($model->id)->image;
            if (env('IMAGE_UPLOAD') == 'local') {
                Storage::disk(env('Disk'))->delete($image);
            } else if (env('IMAGE_UPLOAD') == "cloudinary") {
                Cloudinary::destroy($image);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(AppType::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Skill::class, 'tools', 'project_id', 'skill_id');
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

    public function getImageAttribute($value)
    {
        return env('IMAGE_UPLOAD') == 'local' ? env('Storage_Prefix').$value : $value;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $destination_path = '/images/projects/';

        if (env('IMAGE_UPLOAD') == "cloudinary") {
            // if a base64 was sent, store it in the db
            if (Str::startsWith($value, 'data:image')){
                // Generate a public_id
                $public_id = md5($value.time());
                // upload the image to Cloudinary
                $uploadedFileUrl = Cloudinary::upload($value, [
                    'folder' => $destination_path,
                    'transformation' => [['width'=> 'auto', 'height' => 1200, 'crop'=> 'fit']],
                    'public_id' => $public_id
                ])->getSecurePath();
                // get image url from cloudinary
                $image_url = $uploadedFileUrl;
                // $image_url = Cloudinary::getUrl($uploadedFileUrl);
                // Save the path to the database
                $this->attributes[$attribute_name] = $image_url;
            }
        } else if (env('IMAGE_UPLOAD') == "local") {
            // if the image was erased
            if ($value == null) {
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
    }

}
