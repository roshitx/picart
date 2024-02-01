<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'social_network',
        'link',
        'username',
    ];

    public function user(): BelongsTo
    {
        return $this->belongBelongsTo(User::class);
    }
}
