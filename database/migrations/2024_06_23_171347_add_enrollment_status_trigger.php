<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_enrollment_delete
            AFTER DELETE ON enrollments
            FOR EACH ROW
            BEGIN
                DECLARE studentHasEnrollments INT;

                -- Check if the student still has any enrollments
                SELECT COUNT(*) INTO studentHasEnrollments
                FROM enrollments
                WHERE StudentID = OLD.StudentID;

                -- If no more enrollments, update the student\'s EnrollmentStatus to \'Unenrolled\'
                IF studentHasEnrollments = 0 THEN
                    UPDATE students
                    SET EnrollmentStatus = \'Unenrolled\'
                    WHERE StudentID = OLD.StudentID;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_enrollment_delete');
    }
};
