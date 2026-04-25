<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Cms\Database\Factories\ContactMessage\ContactMessageFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class ContactMessage extends Model 
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'replied_by', 'id');
    }
}
