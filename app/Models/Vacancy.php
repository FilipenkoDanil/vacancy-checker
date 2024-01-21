<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = ['aggregator_id', 'query', 'count'];

    public function aggregator(): BelongsTo
    {
        return $this->belongsTo(Aggregator::class);
    }
}
