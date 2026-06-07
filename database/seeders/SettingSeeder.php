<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Empresa
            ['key' => 'company_name', 'value' => 'JM y JS Alimentos', 'type' => 'text', 'group' => 'empresa'],
            ['key' => 'company_email', 'value' => 'contacto@jmjsalimentos.com', 'type' => 'text', 'group' => 'empresa'],
            ['key' => 'company_phone', 'value' => '+51 999 999 999', 'type' => 'text', 'group' => 'empresa'],
            ['key' => 'company_logo', 'value' => null, 'type' => 'image', 'group' => 'empresa'],
            ['key' => 'company_description', 'value' => 'Plataforma de Capacitación en Calidad Alimentaria', 'type' => 'text', 'group' => 'empresa'],

            // Pagos
            ['key' => 'payment_yape', 'value' => null, 'type' => 'text', 'group' => 'pagos'],
            ['key' => 'payment_plin', 'value' => null, 'type' => 'text', 'group' => 'pagos'],
            ['key' => 'payment_bank_name', 'value' => null, 'type' => 'text', 'group' => 'pagos'],
            ['key' => 'payment_bank_account', 'value' => null, 'type' => 'text', 'group' => 'pagos'],
            ['key' => 'payment_bank_cci', 'value' => null, 'type' => 'text', 'group' => 'pagos'],
            ['key' => 'payment_paypal', 'value' => null, 'type' => 'text', 'group' => 'pagos'],

            // General
            ['key' => 'max_upload_size_mb', 'value' => '50', 'type' => 'text', 'group' => 'general'],
            ['key' => 'max_video_size_mb', 'value' => '500', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
