<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    public function task_submission():BelongsTo
    {
        return $this->belongsTo(TaskSubmission::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
