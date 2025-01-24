<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['author_id', 'review_text', 'rating'];

    // Relación con el autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
