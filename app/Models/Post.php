<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['author_id','tittle', 'content','image'];

    
    // Scope por author id
    public function scopeByUser($query, $userId)
    {
        return $query->where('author_id', $userId);
    }

    public function user()
    {   

        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes()
    {
        return $this->hasMany(PostLikes::class)->where('is_like', true);
    }

    public function dislikes()
    {
        return $this->hasMany(PostLikes::class)->where('is_like', false);
    }

    public function getLikesCount()
    {
        return $this->likes()->count();
    }

    public function getDislikesCount()
    {
        return $this->dislikes()->count();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
