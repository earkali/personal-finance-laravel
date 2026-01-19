<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'description',
        'date',
        'type', // Gelir mi gider mi olduğunu belirtmek için eklendi
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    /**
     * İşlemin kime ait olduğunu belirtir.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * İşlemin hangi kategoriye ait olduğunu belirtir.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}