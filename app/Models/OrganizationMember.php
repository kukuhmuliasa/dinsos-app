<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationMember extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'position',
        'photo',
        'parent_id',
        'sort_order',
    ];

    /**
     * Get the parent member (atasan).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(OrganizationMember::class, 'parent_id');
    }

    /**
     * Get all children members (bawahan), ordered by sort_order.
     */
    public function children(): HasMany
    {
        return $this->hasMany(OrganizationMember::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Recursively eager-load all descendants.
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }
}
