<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'is_approved', 'author_id', 'author_type', 'image', 'pdf'];

    /**
     * Polimorfik aloqada maqola egasi (User yoki boshqa model)
     */
    public function author()
    {
        return $this->morphTo();
    }

    public function index(Request $request)
    {
        // Maqolalarni qidirish yoki hammasini olish
        $query = Article::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $articles = $query->latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
