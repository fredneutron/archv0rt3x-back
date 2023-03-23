<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Bio extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'bio';
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

        static::updating(function (Bio $model) {
            $image = self::find($model->id)->{'profile_picture'};
            if (env('IMAGE_UPLOAD') == 'local') {
                Storage::disk(env('Disk'))->delete($image);
            } else if (env('IMAGE_UPLOAD') == "cloudinary") {
                Cloudinary::destroy($image);
            }
        });

        static::deleting(function (Bio $model) {
            $image = self::find($model->id)->{'profile_picture'};
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

    public function getProfilePictureAttribute($value)
    {
        return env('IMAGE_UPLOAD') == 'local' ? env('Storage_Prefix').$value : $value;
    }

    public function getFullName()
    {
        return $this->first_name.' '.$this->other_name.' '.$this->last_name;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setProfilePictureAttribute($value)
    {
        $attribute_name = 'profile_picture';
        $destination_path = '/images/profile_picture/';

        if (env('IMAGE_UPLOAD') == "cloudinary") {
            // if a base64 was sent, store it in the db
            if (Str::startsWith($value, 'data:image')){
                // Generate a public_id
                $public_id = md5($value.time());
                // upload the image to Cloudinary
                $uploadedFileUrl = Cloudinary::upload($value, [
                    'folder' => $destination_path,
                    'transformation' => [['width'=> 300, 'height' => 300, 'crop'=> 'fit']],
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
