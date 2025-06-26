<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Drop columns we don't need
            $table->dropForeign(['courseId']);
            $table->dropColumn(['courseId', 'dayOfWeek', 'startDate', 'endDate']);

            // Add new columns
            $table->string('purpose')->after('userId');

            // Modify time columns to datetime
            $table->datetime('startTime')->change();
            $table->datetime('endTime')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn('purpose');

            // Add back the old columns
            $table->foreignId('courseId')->constrained('courses');
            $table->string('dayOfWeek');
            $table->date('startDate');
            $table->date('endDate');

            // Change back to time
            $table->time('startTime')->change();
            $table->time('endTime')->change();
        });
    }
};
