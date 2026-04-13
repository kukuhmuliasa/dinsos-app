<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'icon',
        'badge_text',
        'badge_color',
        'contact_info',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    // ── Relationships ──

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ServiceStep::class)->orderBy('step_number');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(ServiceRequirement::class)->orderBy('sort_order');
    }

    public function legalBases(): HasMany
    {
        return $this->hasMany(ServiceLegalBase::class)->orderBy('year', 'desc');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
    }

    public function eligibilityCriteria(): HasMany
    {
        return $this->hasMany(EligibilityCriteria::class)->orderBy('sort_order');
    }
}
