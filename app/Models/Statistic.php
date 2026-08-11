<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'hamlets_data'   => 'array',
        'religion_data'  => 'array',
        'education_data' => 'array',
        'age_group_data' => 'array',
        'occupation_data'=> 'array',
    ];

    /**
     * Hitung total dari kolom data JSON (array of ['label'=>..., 'count'=>...])
     */
    public function totalFromData(string $key): int
    {
        $data = $this->{$key} ?? [];
        return (int) collect($data)->sum('count');
    }

    /**
     * Persen sebuah nilai dari total
     */
    public static function percent(int $value, int $total): float
    {
        if ($total === 0) return 0;
        return round(($value / $total) * 100, 1);
    }
}
