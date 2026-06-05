<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $fillable = [
        'host',
        'port',
        'username',
        'password',
        'status',
        'checked_at',
        'last_error',
    ];

    protected function casts(): array
    {
        return [
            'port' => 'integer',
            'checked_at' => 'datetime',
        ];
    }

    public function scopeSearch(Builder $query, ?string $search): void
    {
        if (blank($search)) {
            return;
        }

        $query->where(function (Builder $query) use ($search): void {
            $query->where('host', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        });
    }
}
