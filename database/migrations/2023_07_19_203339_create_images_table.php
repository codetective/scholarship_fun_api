     <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        class CreateImagesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create('images', function (Blueprint $table) {
                    $table->uuid('id')->primary();
                    $table->uuid('scholarship_application_id');
                    $table->string('image_for');
                    $table->foreign('scholarship_application_id')->references('id')->on('scholarship_applications')->onDelete('cascade');
                    $table->string('url');
                    $table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('images');
            }
        }
