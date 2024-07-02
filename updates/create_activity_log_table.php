<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_exists = Schema::hasTable('admin_activity_log');
        if ($table_exists) {
            return;
        }
        Schema::create('admin_activity_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('log_name', 30)->charset('utf8mb3')->nullable()->comment('表名');
            $table->string('description', 50)->charset('utf8mb3')->comment('描述');
            $table->string('subject_type', 50)->charset('utf8mb3')->comment('对象类型');
            $table->bigInteger('subject_id', false, true)->comment('对象类型');
            // $table->nullableMorphs('subject', 'subject');
            $table->string('event', 20)->charset('utf8mb3')->nullable()->comment('事件');
            $table->string('causer_type', 50)->charset('utf8mb3')->comment('操作人员类型');
            $table->integer('causer_id', false, true)->comment('操作人员ID');
            // $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable()->comment('事件内容');
            $table->string('batch_uuid', 36)->charset('utf8mb3')->nullable();
            $table->timestamps();
            $table->index('log_name', 'idx_log_name');
            $table->index('subject_id', 'idx_subject_id');
            $table->index('causer_id', 'idx_causer_id');
            $table->charset = 'utf8mb3';
            $table->collation = 'utf8mb3_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_activity_log');
    }
}
