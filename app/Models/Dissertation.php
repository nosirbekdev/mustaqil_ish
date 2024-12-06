<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dissertation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'pdf', 'author_id', 'author_type', 'is_approved',];

    public function author()
    {
        return $this->morphTo();
    }

    public function index(Request $request)
    {
        $query = Dissertation::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $dissertations = $query->latest()->paginate(10);

        return view('dissertations.index', compact('dissertations'));
    }
}

