<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormData extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'values' => 'array',
        'completed_at' => 'datetime',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_data';

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function scopeCompleted(Builder $query)
    {
        return $query->whereNotNull('completed_at');
    }
}
