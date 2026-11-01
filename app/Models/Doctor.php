<?php

namespace App\Models;

use App\Models\Concerns\ResolvesImageUrl;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Doctor extends Model
{
    use HasSlug, ResolvesImageUrl;

    protected $fillable = [
        'name', 'slug', 'photo', 'specialty', 'hospital_id',
        'str_number', 'bio', 'years_experience', 'schedule', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'schedule' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->photo) ?? asset('images/placeholder-doctor.webp');
    }
}
