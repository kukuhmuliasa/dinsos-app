<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequirement extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'description',
        'is_mandatory',
        'sort_order',
    ];

    protected $casts = [
        'is_mandatory' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
