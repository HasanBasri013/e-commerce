<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'description'];

    // Accessor to generate the full URL for the image
    public function getImageUrlAttribute()
    {
        return Storage::url('uploads/' . $this->image);
    }

    // Mutator to automatically store the image
    public function setImageAttribute($value)
    {
        if (is_object($value)) {
            $imageName = uniqid(time() . '_') . '.' . $value->extension();
            $value->storeAs('uploads', $imageName, 'public');
            $this->attributes['image'] = $imageName;
        }
    }

    // Automatically delete the image when the banner is deleted
    protected static function booted()
    {
        static::deleting(function ($banner) {
            if (Storage::disk('public')->exists('uploads/' . $banner->image)) {
                Storage::disk('public')->delete('uploads/' . $banner->image);
            }
        });
    }
}

