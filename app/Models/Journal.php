<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'pdf', 'author_id', 'author_type', 'is_approved',];

    public function author()
    {
        return $this->morphTo();
    }

    public function index(Request $request)
    {
        $query = Journal::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $journals = $query->latest()->paginate(10);

        return view('journal.index', compact('journals'));
    }
}
