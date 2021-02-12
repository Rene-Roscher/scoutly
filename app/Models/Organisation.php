<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperOrganisation
 */
class Organisation extends Model
{
    use HasFactory, HasProfilePhoto, HasSlug;

    protected $fillable = [
        'name', 'logo', 'type', 'solution', 'state', 'slug', 'profile_photo_url', 'legal', 'datacenter', 'homepage',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y - H:i'
    ];

    public function scopeNotPending($query)
    {
        return $query->whereNotIn('state', ['PENDING']);
    }

    public function scopePending($query)
    {
        return $query->whereIn('state', ['PENDING']);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
