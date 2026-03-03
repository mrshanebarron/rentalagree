<?php

namespace Database\Seeders;

use App\Models\Agreement;
use App\Models\Registration;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        $admin = User::create([
            'name' => 'Maria van der Berg',
            'email' => 'admin@curarent.com',
            'password' => Hash::make('RentalAgree!Demo2026'),
            'role' => 'admin',
        ]);

        $staff = User::create([
            'name' => 'Carlos Rosario',
            'email' => 'carlos@curarent.com',
            'password' => Hash::make('RentalAgree!Demo2026'),
            'role' => 'staff',
        ]);

        // Vehicles
        $vehicles = [];

        $vehicles['yaris'] = Vehicle::create([
            'make' => 'Toyota', 'model' => 'Yaris', 'year' => 2024,
            'license_plate' => 'ABC-123', 'color' => 'White', 'category' => 'economy',
            'daily_rate' => 35.00, 'status' => 'available', 'current_mileage' => 12450,
        ]);

        $vehicles['accent'] = Vehicle::create([
            'make' => 'Hyundai', 'model' => 'Accent', 'year' => 2023,
            'license_plate' => 'ABC-456', 'color' => 'Silver', 'category' => 'economy',
            'daily_rate' => 32.00, 'status' => 'available', 'current_mileage' => 18720,
        ]);

        $vehicles['sportage'] = Vehicle::create([
            'make' => 'Kia', 'model' => 'Sportage', 'year' => 2024,
            'license_plate' => 'DEF-789', 'color' => 'Blue', 'category' => 'compact',
            'daily_rate' => 55.00, 'status' => 'rented', 'current_mileage' => 8300,
        ]);

        $vehicles['kicks'] = Vehicle::create([
            'make' => 'Nissan', 'model' => 'Kicks', 'year' => 2023,
            'license_plate' => 'DEF-012', 'color' => 'Red', 'category' => 'compact',
            'daily_rate' => 50.00, 'status' => 'rented', 'current_mileage' => 22100,
        ]);

        $vehicles['rav4'] = Vehicle::create([
            'make' => 'Toyota', 'model' => 'RAV4', 'year' => 2024,
            'license_plate' => 'GHI-345', 'color' => 'Black', 'category' => 'suv',
            'daily_rate' => 75.00, 'status' => 'available', 'current_mileage' => 5600,
        ]);

        $vehicles['wrangler'] = Vehicle::create([
            'make' => 'Jeep', 'model' => 'Wrangler', 'year' => 2023,
            'license_plate' => 'GHI-678', 'color' => 'Orange', 'category' => 'suv',
            'daily_rate' => 85.00, 'status' => 'maintenance', 'current_mileage' => 31200,
        ]);

        $vehicles['bmw3'] = Vehicle::create([
            'make' => 'BMW', 'model' => '3 Series', 'year' => 2024,
            'license_plate' => 'JKL-901', 'color' => 'White', 'category' => 'luxury',
            'daily_rate' => 120.00, 'status' => 'rented', 'current_mileage' => 3200,
        ]);

        $vehicles['cclass'] = Vehicle::create([
            'make' => 'Mercedes', 'model' => 'C-Class', 'year' => 2023,
            'license_plate' => 'JKL-234', 'color' => 'Black', 'category' => 'luxury',
            'daily_rate' => 130.00, 'status' => 'available', 'current_mileage' => 9800,
        ]);

        // Registrations
        $tomorrow = now()->addDay();
        $today = now();
        $yesterday = now()->subDay();
        $lastWeek = now()->subWeek();
        $threeWeeksAgo = now()->subWeeks(3);

        $reg1 = Registration::create([
            'confirmation_code' => 'CUR-S7J2',
            'full_name' => 'Sarah Johnson',
            'email' => 'sarah.johnson@email.com',
            'phone' => '+1 555 234 5678',
            'date_of_birth' => '1990-06-15',
            'license_number' => 'D1234567',
            'license_country' => 'United States',
            'license_expiry' => '2028-06-15',
            'emergency_contact_name' => 'Mike Johnson',
            'emergency_contact_phone' => '+1 555 345 6789',
            'pickup_date' => $tomorrow->format('Y-m-d'),
            'return_date' => $tomorrow->copy()->addDays(5)->format('Y-m-d'),
            'vehicle_preference' => 'economy',
            'hotel_name' => 'Marriott Beach Resort',
            'flight_number' => 'AA1847',
            'status' => 'pending',
        ]);

        $reg2 = Registration::create([
            'confirmation_code' => 'CUR-H4M8',
            'full_name' => 'Hans Mueller',
            'email' => 'hans.mueller@email.de',
            'phone' => '+49 170 1234567',
            'date_of_birth' => '1985-03-22',
            'license_number' => 'B07812345',
            'license_country' => 'Germany',
            'license_expiry' => '2029-03-22',
            'emergency_contact_name' => 'Greta Mueller',
            'emergency_contact_phone' => '+49 170 2345678',
            'pickup_date' => $today->format('Y-m-d'),
            'return_date' => $today->copy()->addDays(7)->format('Y-m-d'),
            'vehicle_preference' => 'suv',
            'hotel_name' => 'Sunscape Curacao',
            'flight_number' => null,
            'status' => 'pending',
        ]);

        $reg3 = Registration::create([
            'confirmation_code' => 'CUR-A2P5',
            'full_name' => 'Ana Pereira',
            'email' => 'ana.pereira@email.com.br',
            'phone' => '+55 11 98765 4321',
            'date_of_birth' => '1992-11-08',
            'license_number' => '04567890123',
            'license_country' => 'Brazil',
            'license_expiry' => '2027-11-08',
            'emergency_contact_name' => 'Ricardo Pereira',
            'emergency_contact_phone' => '+55 11 97654 3210',
            'pickup_date' => $yesterday->format('Y-m-d'),
            'return_date' => $yesterday->copy()->addDays(4)->format('Y-m-d'),
            'vehicle_preference' => 'compact',
            'hotel_name' => 'Lions Dive Beach Resort',
            'flight_number' => 'KL791',
            'status' => 'in_progress',
        ]);

        $reg4 = Registration::create([
            'confirmation_code' => 'CUR-J9W1',
            'full_name' => 'James Williams',
            'email' => 'james.williams@email.co.uk',
            'phone' => '+44 7700 900123',
            'date_of_birth' => '1978-09-30',
            'license_number' => 'WILLI709301JW',
            'license_country' => 'United Kingdom',
            'license_expiry' => '2030-09-30',
            'emergency_contact_name' => 'Emma Williams',
            'emergency_contact_phone' => '+44 7700 900456',
            'pickup_date' => $lastWeek->format('Y-m-d'),
            'return_date' => $lastWeek->copy()->addDays(10)->format('Y-m-d'),
            'vehicle_preference' => 'luxury',
            'hotel_name' => 'Renaissance Wind Creek',
            'flight_number' => 'BA2263',
            'status' => 'completed',
        ]);

        $reg5 = Registration::create([
            'confirmation_code' => 'CUR-Y6T3',
            'full_name' => 'Yuki Tanaka',
            'email' => 'yuki.tanaka@email.jp',
            'phone' => '+81 90 1234 5678',
            'date_of_birth' => '1995-01-20',
            'license_number' => '012345678901',
            'license_country' => 'Japan',
            'license_expiry' => '2028-01-20',
            'emergency_contact_name' => 'Kenji Tanaka',
            'emergency_contact_phone' => '+81 90 2345 6789',
            'pickup_date' => $threeWeeksAgo->format('Y-m-d'),
            'return_date' => $threeWeeksAgo->copy()->addDays(6)->format('Y-m-d'),
            'vehicle_preference' => 'compact',
            'hotel_name' => 'Hilton Curacao',
            'flight_number' => null,
            'status' => 'expired',
        ]);

        // Agreement 1: Ana Pereira — Kia Sportage — In Progress (step 4)
        Agreement::create([
            'registration_id' => $reg3->id,
            'vehicle_id' => $vehicles['sportage']->id,
            'user_id' => $staff->id,
            'agreement_number' => 'AGR-2026-0003',
            'pickup_date' => $reg3->pickup_date,
            'return_date' => $reg3->return_date,
            'daily_rate' => 55.00,
            'total_cost' => 220.00,
            'deposit_amount' => 300.00,
            'insurance_option' => 'basic',
            'insurance_cost' => 60.00,
            'current_step' => 4,
            'section_1_confirmed' => true,
            'section_2_confirmed' => true,
            'section_3_confirmed' => true,
            'section_3_initials' => 'AP',
            'section_4_confirmed' => false,
            'status' => 'in_progress',
        ]);

        // Agreement 2: James Williams — BMW 3 Series — Signed
        Agreement::create([
            'registration_id' => $reg4->id,
            'vehicle_id' => $vehicles['bmw3']->id,
            'user_id' => $admin->id,
            'agreement_number' => 'AGR-2026-0001',
            'pickup_date' => $reg4->pickup_date,
            'return_date' => $reg4->return_date,
            'daily_rate' => 120.00,
            'total_cost' => 1200.00,
            'deposit_amount' => 500.00,
            'insurance_option' => 'premium',
            'insurance_cost' => 250.00,
            'current_step' => 8,
            'section_1_confirmed' => true,
            'section_2_confirmed' => true,
            'section_3_confirmed' => true,
            'section_3_initials' => 'JW',
            'section_4_confirmed' => true,
            'section_4_initials' => 'JW',
            'section_5_confirmed' => true,
            'section_5_initials' => 'JW',
            'section_6_confirmed' => true,
            'section_6_initials' => 'JW',
            'section_7_confirmed' => true,
            'section_7_initials' => 'JW',
            'sole_driver' => false,
            'additional_drivers' => [
                ['name' => 'Emma Williams', 'license_number' => 'WILLI780930EW'],
            ],
            'signature' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAu4AAACYCAYAAAC3e2jLAAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8WlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4NCjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIj4NCiA8eG1wTU06SGlzdG9yeT4NCiA8L3htcE1NOkhpc3Rvcnk+DQo8L3g6eG1wbWV0YT4NCjw/eHBhY2tldCBlbmQ9InIiPz4K',
            'signed_at' => $lastWeek->copy()->addHours(2),
            'status' => 'signed',
        ]);
    }
}
