<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Update contact details in site_settings and page_contents tables
 * to the correct address (no trailing comma before Lagos) and
 * correct WhatsApp number (2349122388541).
 */
return new class extends Migration
{
    public function up(): void
    {
        // Fix address in site_settings
        DB::table('site_settings')
            ->where('key', 'address')
            ->update(['value' => '5, Charity Road, Opposite UBA Oko/Oba Ifako-Ijaye Ijaiye Lagos']);

        // Fix address in page_contents (contact page info section)
        DB::table('page_contents')
            ->where('key', 'address')
            ->update(['value' => '5, Charity Road, Opposite UBA Oko/Oba Ifako-Ijaye Ijaiye Lagos']);

        // Fix WhatsApp number in site_settings
        DB::table('site_settings')
            ->where('key', 'whatsapp_number')
            ->where('value', '2348000000000')
            ->update(['value' => '2349122388541']);

        // Fix phone_1 if it has wrong placeholder
        DB::table('site_settings')
            ->where('key', 'phone_1')
            ->where('value', '+234 800 000 0000')
            ->update(['value' => '08105494713']);

        // Fix phone_2 / WhatsApp display number if it has wrong placeholder
        DB::table('site_settings')
            ->where('key', 'phone_2')
            ->where('value', '+234 900 000 0000')
            ->update(['value' => '09122388541']);
    }

    public function down(): void {}
};
