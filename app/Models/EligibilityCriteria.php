<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EligibilityCriteria extends Model
{
    protected $table = 'eligibility_criteria';

    protected $fillable = [
        'service_id',
        'criteria_name',
        'criteria_type',
        'operator',
        'value',
        'display_label',
        'sort_order',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
