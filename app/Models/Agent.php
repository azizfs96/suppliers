<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'name',
    'brands',
    'inventory_system_type',
    'inventory_system_note',
    'sales_rep_name',
    'phone',
    'location',
])]
class Agent extends Model
{
    /**
     * @return array<string, string>
     */
    public static function inventorySystemTypeLabels(): array
    {
        return [
            'erp' => 'نظام ERP',
            'excel' => 'Excel',
            'cloud' => 'نظام سحابي للمخزون',
            'accounting' => 'نظام محاسبي',
            'none' => 'لا يوجد نظام',
            'other' => 'أخرى',
        ];
    }

    public function inventorySystemDisplay(): string
    {
        $labels = self::inventorySystemTypeLabels();
        $type = $this->inventory_system_type ?? 'none';
        $base = $labels[$type] ?? $type;
        if (filled($this->inventory_system_note)) {
            return $base.' — '.$this->inventory_system_note;
        }

        return $base;
    }

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'brands' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
