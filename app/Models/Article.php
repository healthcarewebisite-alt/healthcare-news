<?php

namespace App\Models;

use App\Models\Concerns\ResolvesImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug, SoftDeletes, ResolvesImageUrl;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'featured_image', 'featured_image_alt',
        'category_id', 'author_id',
        'is_headline', 'is_trending', 'is_breaking', 'is_featured',
        'status', 'published_at',
        'views_count', 'meta_title', 'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_headline' => 'boolean',
            'is_trending' => 'boolean',
            'is_breaking' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved')->whereNull('parent_id');
    }

    // ============ SCOPES sesuai Struktur Homepage di konsep ============

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /** Hero News - Berita Utama (70%) */
    public function scopeHeadline($query)
    {
        return $query->where('is_headline', true);
    }

    /** Hero News - Trending (30%), list 1-4 */
    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    /** Breaking News - strip merah berjalan otomatis */
    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    /** Featured Article - artikel pilihan editor, background abu muda */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderByDesc('published_at');
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views_count');
    }

    public function scopeInCategory($query, string $categorySlug)
    {
        return $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
    }

    // ============ Helper ============

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->featured_image) ?? asset('images/placeholder-article.webp');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));
        return max(1, (int) ceil($words / 200));
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
