   <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateScholarshipApplicationsTable extends Migration
    {
        public function up()
        {
            Schema::create('scholarship_applications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('application_code')->unique();
                $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
                $table->string('name');
                $table->string('gender');
                $table->string('email')->unique();
                $table->string('dob');
                $table->string('disability');
                $table->string('programme_of_study');
                $table->string('course_of_study');
                $table->string('lga');
                $table->enum('review_status', ['reviwed', 'unreviewed'])->default('unreviewed');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('scholarship_applications');
        }
    }
