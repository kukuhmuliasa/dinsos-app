<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceLegalBase extends Model
{
    protected $fillable = [
        'service_id',
        'regulation_number',
        'regulation_title',
        'regulation_type',
        'year',
        'document_url',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
