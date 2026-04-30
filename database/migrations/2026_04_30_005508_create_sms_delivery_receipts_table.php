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
        Schema::create('sms_delivery_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->index();
            $table->string('sender_address')->nullable();
            $table->string('destination_address')->nullable();
            $table->string('status')->index();
            $table->integer('error_code')->nullable();
            $table->timestamp('smsc_timestamp')->nullable();
            $table->string('client_reference')->nullable()->index();
            $table->json('raw_payload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_delivery_receipts');
    }
};
