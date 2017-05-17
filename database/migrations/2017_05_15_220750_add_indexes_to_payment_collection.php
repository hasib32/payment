<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToPaymentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_payment1', function($collection)
        {
            $collection->index([
                'physician_first_name'      => 'text',
                'physician_last_name'       => 'text',
                'applicable_name'           => 'text',
                'teaching_hospital_name'    => 'text'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('medical_payment', function($collection)
        {
            $collection->dropIndex('physician_first_name');
            $collection->dropIndex('applicable_name');
            $collection->dropIndex('teaching_hospital_name');
        });
    }
}
