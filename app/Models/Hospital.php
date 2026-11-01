<?php

namespace App\Models;

use App\Models\Concerns\ResolvesImageUrl;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Hospital extends Model
{
    use HasSlug, ResolvesImageUrl;

    protected $fillable = [
        'name', 'slug', 'logo', 'cover_image', 'type',
        'city', 'province', 'address', 'phone', 'email', 'website',
        'latitude', 'longitude', 'rating', 'reviews_count',
        'description', 'facilities', 'is_bpjs', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'is_bpjs' => 'boolean',
            'is_active' => 'boolean',
            'rating' => 'decimal:1',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->logo) ?? asset('images/placeholder-hospital.webp');
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->resolveImageUrl($this->cover_image);
    }
}
