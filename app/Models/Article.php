<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';

    public function getStatusLabelAttribute()
    {
        if ($this->status == 'DRAFT') {
            return '<div class="d-flex align-items-center text-warning">	
            <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
            <span>Draft</span>
        </div>';
        }
        return '<div class="d-flex align-items-center text-success">	
        <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
        <span>Publish</span>
        </div>';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value); 
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function publish_comments()
    {
        return $this->comments()->where('status', 'PUBLISH');
    }

    public function draft_comments()
    {
        return $this->comments()->where('status', 'DRAFT');
    }
}