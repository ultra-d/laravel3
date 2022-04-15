<?php

use App\Constants\PaymentStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->char('reference');
            $table->enum('payment_status', (new PaymentStatus())->toArray())->default(PaymentStatus::PENDING);
            $table->unsignedBigInteger('payment_reference')->nullable();
            $table->string('payment_url', 100)->nullable();
            $table->unsignedBigInteger('total');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('invoices');
    }
}
