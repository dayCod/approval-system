<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('consent_id')->constrained('consents')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('evidence_img')->comment('Bukti Gambar Izin');
            $table->boolean('need_remark');
            $table->longText('remark')->nullable();
            $table->integer('status')->default(0)->comment('0:process, 1:approved, 2:rejected, 3:revise');
            $table->string('revise_notes')->nullable()->comment('Kalo Ada Revisi Kolom Ini Menjadi Notes Dari Admin');
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
        Schema::dropIfExists('approval_applications');
    }
};
