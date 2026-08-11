<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'column_id',
        'title',
        'description',
        'order',
    ];

    public function column(): BelongsTo // 1:1
    {
        return $this->belongsTo(Column::class);
    }

    public function project(): BelongsTo // 1:1
    {
        return $this->belongsTo(Project::class);
    }
}
