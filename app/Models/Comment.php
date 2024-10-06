<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function child()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function publish_child()
    {
        return $this->child()->where('status', 'PUBLISH');
    }
    
    public function getStatusLabelAttribute()
    {
        if ($this->status == 'DRAFT') {
            return '<div class="d-flex align-items-center text-warning">	
            <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
            <span>Pending</span>
            </div>';
        }
        return '<div class="d-flex align-items-center text-success">	
            <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
            <span>Publish</span>
            </div>';
    }
}