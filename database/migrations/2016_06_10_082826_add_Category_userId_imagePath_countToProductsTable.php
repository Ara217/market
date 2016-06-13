<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryUserIdImagePathCountToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('products', ['user_id', 'category', 'count', 'image_path'])) {
            Schema::table('products', function(Blueprint $builder) {
                $builder->string('user_id')->after('id');
                $builder->string('category')->after('title');
                $builder->string('count')->after('price');
                $builder->string('image_path')->before('created_at');
            });
        }
    }


    public function down()
    {
        if (Schema::hasColumns('products', ['user_id', 'category', 'count', 'image_path'])) {
            Schema::table('products', function(Blueprint $builder) {
                $builder->dropColumn('user_id');
                $builder->dropColumn('category');
                $builder->dropColumn('count');
                $builder->dropColumn('image_path');
            });
        }
    }
}
