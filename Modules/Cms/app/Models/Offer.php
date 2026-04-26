<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Cms\Database\Factories\Offer\OfferFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Offer extends Model 
{
    /** @use HasFactory<OfferFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'applicable_room_types' => 'array',
        'is_active' => 'boolean',
        'discount_value' => 'float',
        'min_nights' => 'integer',
        'max_nights' => 'integer',
    ];

    
    
}
