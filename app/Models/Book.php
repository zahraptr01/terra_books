<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Book extends Model {
    use HasFactory;

    protected $fillable = ['title', 'summary', 'image', 'stok', 'genre_id'];

    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_books')->withTimestamps();
    }
}
