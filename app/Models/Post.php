<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements  Feedable
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['author', 'category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query->whereHas('category', fn($query) => $query->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn ($query, $category) =>
        $query->whereHas('author', fn($query) => $query->where('username', $category)));
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'link' => "/posts/$this->slug",
            'summary' => $this->excerpt,
            'updated' => $this->created_at,
            'authorName' => $this->author->name
        ]);
    }

    public static function getFeedItems()
    {
        return Post::with('author')->published()->get();
    }
}
