    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDepositTransactionsTable extends Migration
    {
        public function up()
        {
            Schema::create('deposit_transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('payment_option_id')->constrained()->onDelete('cascade');
                $table->decimal('amount', 15, 2);
                $table->string('bank_account')->nullable();
                $table->string('transfer_content')->nullable();
                $table->string('transaction_code')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('deposit_transactions');
        }
    }

