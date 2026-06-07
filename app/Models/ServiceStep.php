<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStep extends Model
{
    protected $fillable = [
        'service_id',
        'step_number',
        'title',
        'description',
        'icon',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
