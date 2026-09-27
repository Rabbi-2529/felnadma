<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    
    protected $fillable = [
        'page',
        'title',
        'description',
        'nav_route'
    ];

    public static function getArticles()
    {
        $articles = Article::get();
        return $articles;
    }

    /**
     * Get the navbar item associated with this article
     */
    public function navbar()
    {
        return $this->belongsTo(Navbar::class, 'nav_route', 'nav_route');
    }
}