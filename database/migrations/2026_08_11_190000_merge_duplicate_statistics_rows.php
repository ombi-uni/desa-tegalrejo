<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Merge any duplicate rows in statistics table into a single record,
     * and prevent future duplicate creation by removing the "Create" button
     * via code (handled in Filament pages).
     *
     * This migration merges row id=2 (admin-entered data) into row id=1 (original),
     * then deletes the duplicate.
     */
    public function up(): void
    {
        $rows = DB::table('statistics')->orderBy('id')->get();

        if ($rows->count() > 1) {
            // Use the LAST row as the source of truth (most recently edited by admin)
            $source = $rows->last();
            $target = $rows->first();

            DB::table('statistics')->where('id', $target->id)->update([
                'population_count'    => $source->population_count ?: $target->population_count,
                'building_count'      => $source->building_count ?: $target->building_count,
                'facility_count'      => $source->facility_count ?: $target->facility_count,
                'worship_place_count' => $source->worship_place_count ?: $target->worship_place_count,
                'male_count'          => $source->male_count ?: $target->male_count,
                'female_count'        => $source->female_count ?: $target->female_count,
                'household_count'     => $source->household_count ?: $target->household_count,
                'rt_count'            => $source->rt_count ?: $target->rt_count,
                'rw_count'            => $source->rw_count ?: $target->rw_count,
                'hamlets_data'        => $source->hamlets_data ?? $target->hamlets_data,
                'religion_data'       => $source->religion_data ?? $target->religion_data,
                'education_data'      => $source->education_data ?? $target->education_data,
                'age_group_data'      => $source->age_group_data ?? $target->age_group_data,
                'occupation_data'     => $source->occupation_data ?? $target->occupation_data,
                'last_updated_note'   => $source->last_updated_note ?? $target->last_updated_note,
                'updated_at'          => now(),
            ]);

            // Delete all rows except the first (keep id=1)
            DB::table('statistics')->where('id', '!=', $target->id)->delete();
        }
    }

    public function down(): void
    {
        // Not reversible
    }
};
