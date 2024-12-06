<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avtoreferat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'pdf', 'author_id', 'author_type', 'is_approved',];

    public function author()
    {
        return $this->morphTo();
    }

    public function index(Request $request)
    {
        $query = Avtoreferat::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $avtoreferats = $query->latest()->paginate(10);

        return view('avtoreferats.index', compact('avtoreferats'));
    }
}
