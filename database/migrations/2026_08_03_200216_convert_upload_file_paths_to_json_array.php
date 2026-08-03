<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected array $tables = ['project_reports', 'sheets', 'portfolios'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $table) {
            DB::statement("ALTER TABLE `{$table}` MODIFY `file_path` TEXT NULL");
        }

        foreach ($this->tables as $table) {
            DB::table($table)->whereNotNull('file_path')->where('file_path', '!=', '')->orderBy('id')->get(['id', 'file_path'])->each(function ($row) use ($table) {
                $decoded = json_decode($row->file_path, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return;
                }

                DB::table($table)->where('id', $row->id)->update([
                    'file_path' => json_encode([$row->file_path]),
                ]);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            DB::table($table)->whereNotNull('file_path')->orderBy('id')->get(['id', 'file_path'])->each(function ($row) use ($table) {
                $decoded = json_decode($row->file_path, true);
                $first = is_array($decoded) ? ($decoded[0] ?? '') : $row->file_path;

                DB::table($table)->where('id', $row->id)->update(['file_path' => $first]);
            });

            DB::statement("ALTER TABLE `{$table}` MODIFY `file_path` VARCHAR(255) NOT NULL");
        }
    }
};
