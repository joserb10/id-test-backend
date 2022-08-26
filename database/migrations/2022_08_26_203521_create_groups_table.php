<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::table('groups')->insert(array('id'=>'1','name'=>'Matemáticas', 'image'=>'https://educacion30.b-cdn.net/wp-content/uploads/2020/03/fondo-matematicas_23-2148146270.jpg'));
        DB::table('groups')->insert(array('id'=>'2','name'=>'Letras', 'image'=>'https://1.bp.blogspot.com/-qf_5TTWFDZY/YGk-O2_67gI/AAAAAAAAU8o/gRbvVfnBx9ESb2UJfdp821vlRAuehtfmACLcBGAsYHQ/s459/banner%2Bsinonimos%2Bantonimos.jpg'));
        DB::table('groups')->insert(array('id'=>'3','name'=>'Ciencias', 'image'=>'https://economipedia.com/wp-content/uploads/Diferencia-entre-ciencia-y-disciplina.jpg'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
