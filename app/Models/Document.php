<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'registration_id',
        'file_type',
        'file_path',
        'is_verified',
        'notes',
    ];

    /**
     * Cast kolom is_verified menjadi boolean secara otomatis
     */
    protected $casts = [
        'is_verified' => 'boolean',
    ];

    /**
     * Relasi ke model Registration (Many to One)
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
