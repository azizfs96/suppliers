<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach (DB::table('agents')->whereNotNull('brands')->cursor() as $row) {
            $v = $row->brands;
            if ($v === '' || $v === null) {
                continue;
            }
            $decoded = json_decode($v, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                continue;
            }
            $parts = preg_split('/\s*،\s*|\s*,\s*|\r\n|\n|\r/', (string) $v, -1, PREG_SPLIT_NO_EMPTY);
            $parts = array_values(array_filter(array_map('trim', $parts)));
            DB::table('agents')->where('id', $row->id)->update([
                'brands' => json_encode($parts, JSON_UNESCAPED_UNICODE),
            ]);
        }
    }

    public function down(): void
    {
        foreach (DB::table('agents')->whereNotNull('brands')->cursor() as $row) {
            $decoded = json_decode($row->brands, true);
            if (! is_array($decoded) || $decoded === []) {
                continue;
            }
            DB::table('agents')->where('id', $row->id)->update([
                'brands' => implode('، ', $decoded),
            ]);
        }
    }
};
