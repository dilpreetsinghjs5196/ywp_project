<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::updateOrCreate(
            ['code' => 'TESTAPPROVED'],
            [
                'user_name' => 'John Doe',
                'user_email' => 'john@example.com',
                'discount_amount' => 500.00,
                'status' => 'approved',
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'TESTPENDING'],
            [
                'user_name' => 'Jane Smith',
                'user_email' => 'jane@example.com',
                'discount_amount' => 500.00,
                'status' => 'pending',
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'TESTREJECTED'],
            [
                'user_name' => 'Bob Johnson',
                'user_email' => 'bob@example.com',
                'discount_amount' => 500.00,
                'status' => 'rejected',
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'TESTUSED'],
            [
                'user_name' => 'Alice Williams',
                'user_email' => 'alice@example.com',
                'discount_amount' => 500.00,
                'status' => 'used',
            ]
        );
    }
}
