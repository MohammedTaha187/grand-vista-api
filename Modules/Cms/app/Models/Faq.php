<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Cms\Database\Factories\Faq\FaqFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Faq extends Model 
{
    /** @use HasFactory<FaqFactory> */
    use HasFactory, HasUuids;

    
    

    
    
}
