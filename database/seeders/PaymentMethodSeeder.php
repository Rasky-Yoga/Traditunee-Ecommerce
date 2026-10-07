<?php
namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            [
                'bank_name' => 'Bank BCA',
                'account_number' => '1234567890',
                'account_name' => 'Toko Alat Musik Nusantara',
                'is_active' => true,
            ],
            [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'Toko Alat Musik Nusantara',
                'is_active' => true,
            ],
            [
                'bank_name' => 'Bank BNI',
                'account_number' => '5555666677',
                'account_name' => 'Toko Alat Musik Nusantara',
                'is_active' => true,
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}