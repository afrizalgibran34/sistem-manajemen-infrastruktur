// database/migrations/xxxx_xx_xx_create_kec_kel_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kec_kel', function (Blueprint $table) {
            $table->increments('id_kec_kel');
            $table->string('nama_kec_kel');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kec_kel');
    }
};