<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recievable extends Model
{
    use HasFactory;
    protected $fillable = [
        'newest_collection_id'
    ];
    public function NewestCollection()
    {
        return $this->belongsTo(NewestCollection::class);
    }
}
