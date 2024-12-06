<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Europe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'pdf', 'author_id', 'author_type', 'is_approved',];

    public function author()
    {
        return $this->morphTo();
    }

    public function index(Request $request)
    {
        $query = Europe::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $europes = $query->latest()->paginate(10);

        return view('europes.index', compact('europes'));
    }
}
