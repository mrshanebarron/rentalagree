<?php

namespace Tests\Feature;

use App\Models\Agreement;
use App\Models\Registration;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $staff;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Maria van der Berg',
            'email' => 'admin@curarent.com',
            'password' => bcrypt('RentalAgree!Demo2026'),
            'role' => 'admin',
        ]);

        $this->staff = User::create([
            'name' => 'Carlos Rosario',
            'email' => 'carlos@curarent.com',
            'password' => bcrypt('RentalAgree!Demo2026'),
            'role' => 'staff',
        ]);
    }

    // Public routes
    public function test_landing_page_returns_200(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_register_page_returns_200(): void
    {
        $this->get('/register')->assertStatus(200);
    }

    public function test_login_page_returns_200(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    // Auth
    public function test_login_works_with_valid_credentials(): void
    {
        $this->post('/login', [
            'email' => 'admin@curarent.com',
            'password' => 'RentalAgree!Demo2026',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->post('/login', [
            'email' => 'admin@curarent.com',
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');
    }

    public function test_dashboard_requires_auth(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    // Dashboard
    public function test_dashboard_loads_for_authenticated_user(): void
    {
        $this->actingAs($this->admin)->get('/dashboard')->assertStatus(200);
    }

    // Registration flow
    public function test_pre_registration_creates_record(): void
    {
        $response = $this->post('/register', [
            'full_name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '+1 555 000 0000',
            'date_of_birth' => '1990-01-01',
            'license_number' => 'TEST123',
            'license_country' => 'United States',
            'license_expiry' => '2028-12-31',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '+1 555 111 1111',
            'pickup_date' => now()->addDay()->format('Y-m-d'),
            'return_date' => now()->addDays(5)->format('Y-m-d'),
            'vehicle_preference' => 'economy',
            'hotel_name' => 'Test Hotel',
        ]);

        $this->assertDatabaseHas('registrations', [
            'full_name' => 'Test Customer',
            'email' => 'test@example.com',
            'status' => 'pending',
        ]);

        $registration = Registration::where('email', 'test@example.com')->first();
        $response->assertRedirect(route('register.confirmation', $registration->confirmation_code));
    }

    public function test_confirmation_page_shows_code(): void
    {
        $reg = Registration::create([
            'confirmation_code' => 'CUR-TEST',
            'full_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '+1 555 0000',
            'date_of_birth' => '1990-01-01',
            'license_number' => 'TEST',
            'license_country' => 'US',
            'license_expiry' => '2028-01-01',
            'emergency_contact_name' => 'EC',
            'emergency_contact_phone' => '+1 555 1111',
            'pickup_date' => now()->addDay(),
            'return_date' => now()->addDays(3),
            'vehicle_preference' => 'economy',
            'hotel_name' => 'Hotel',
            'status' => 'pending',
        ]);

        $this->get("/register/confirmation/CUR-TEST")
            ->assertStatus(200)
            ->assertSee('CUR-TEST');
    }

    // Registrations dashboard
    public function test_registrations_list_loads(): void
    {
        $this->actingAs($this->admin)->get('/dashboard/registrations')->assertStatus(200);
    }

    // Fleet management
    public function test_fleet_list_loads(): void
    {
        $this->actingAs($this->admin)->get('/dashboard/fleet')->assertStatus(200);
    }

    public function test_fleet_create_form_loads(): void
    {
        $this->actingAs($this->admin)->get('/dashboard/fleet/create')->assertStatus(200);
    }

    public function test_can_add_vehicle(): void
    {
        $this->actingAs($this->admin)->post('/dashboard/fleet', [
            'make' => 'Toyota',
            'model' => 'Yaris',
            'year' => 2024,
            'license_plate' => 'TEST-001',
            'color' => 'White',
            'category' => 'economy',
            'daily_rate' => 35.00,
            'status' => 'available',
            'current_mileage' => 1000,
        ])->assertRedirect(route('dashboard.fleet.index'));

        $this->assertDatabaseHas('vehicles', ['license_plate' => 'TEST-001']);
    }

    // Agreement flow
    public function test_agreement_creation_flow(): void
    {
        $vehicle = Vehicle::create([
            'make' => 'Toyota', 'model' => 'Yaris', 'year' => 2024,
            'license_plate' => 'TST-001', 'color' => 'White', 'category' => 'economy',
            'daily_rate' => 35.00, 'status' => 'available', 'current_mileage' => 5000,
        ]);

        $reg = Registration::create([
            'confirmation_code' => 'CUR-T1X1',
            'full_name' => 'Test Driver',
            'email' => 'driver@test.com',
            'phone' => '+1 555 2222',
            'date_of_birth' => '1990-01-01',
            'license_number' => 'DRV123',
            'license_country' => 'US',
            'license_expiry' => '2028-01-01',
            'emergency_contact_name' => 'EC',
            'emergency_contact_phone' => '+1 555 3333',
            'pickup_date' => now()->addDay(),
            'return_date' => now()->addDays(4),
            'vehicle_preference' => 'economy',
            'hotel_name' => 'Test Hotel',
            'status' => 'pending',
        ]);

        $this->actingAs($this->admin)->post("/dashboard/agreements/create/{$reg->id}", [
            'vehicle_id' => $vehicle->id,
            'insurance_option' => 'basic',
            'deposit_amount' => 300,
        ]);

        $this->assertDatabaseHas('agreements', [
            'registration_id' => $reg->id,
            'vehicle_id' => $vehicle->id,
            'status' => 'in_progress',
        ]);
    }

    // Signed URL agreement access
    public function test_signed_url_grants_access_to_agreement(): void
    {
        $vehicle = Vehicle::create([
            'make' => 'Test', 'model' => 'Car', 'year' => 2024,
            'license_plate' => 'SIG-001', 'color' => 'Blue', 'category' => 'compact',
            'daily_rate' => 50, 'status' => 'rented', 'current_mileage' => 1000,
        ]);

        $reg = Registration::create([
            'confirmation_code' => 'CUR-S1G1',
            'full_name' => 'Signer Test',
            'email' => 'signer@test.com',
            'phone' => '+1 555 4444',
            'date_of_birth' => '1990-01-01',
            'license_number' => 'SIG123',
            'license_country' => 'US',
            'license_expiry' => '2028-01-01',
            'emergency_contact_name' => 'EC',
            'emergency_contact_phone' => '+1 555 5555',
            'pickup_date' => now(),
            'return_date' => now()->addDays(3),
            'vehicle_preference' => 'compact',
            'hotel_name' => 'Hotel',
            'status' => 'in_progress',
        ]);

        $agreement = Agreement::create([
            'registration_id' => $reg->id,
            'vehicle_id' => $vehicle->id,
            'user_id' => $this->admin->id,
            'agreement_number' => 'AGR-2026-TEST',
            'pickup_date' => $reg->pickup_date,
            'return_date' => $reg->return_date,
            'daily_rate' => 50,
            'total_cost' => 150,
            'deposit_amount' => 300,
            'insurance_option' => 'basic',
            'insurance_cost' => 45,
            'status' => 'in_progress',
        ]);

        // Without signed URL, should fail
        $this->get("/agreements/{$agreement->id}/sign")->assertStatus(403);

        // With signed URL, should succeed
        $signedUrl = URL::signedRoute('agreements.sign', ['agreement' => $agreement->id]);
        $this->get($signedUrl)->assertStatus(200);
    }

    // Agreements list
    public function test_agreements_list_loads(): void
    {
        $this->actingAs($this->admin)->get('/dashboard/agreements')->assertStatus(200);
    }

    // PDF download
    public function test_pdf_download_for_signed_agreement(): void
    {
        $vehicle = Vehicle::create([
            'make' => 'BMW', 'model' => '3 Series', 'year' => 2024,
            'license_plate' => 'PDF-001', 'color' => 'White', 'category' => 'luxury',
            'daily_rate' => 120, 'status' => 'rented', 'current_mileage' => 3000,
        ]);

        $reg = Registration::create([
            'confirmation_code' => 'CUR-P1D1',
            'full_name' => 'PDF Test',
            'email' => 'pdf@test.com',
            'phone' => '+1 555 6666',
            'date_of_birth' => '1978-09-30',
            'license_number' => 'PDF123',
            'license_country' => 'UK',
            'license_expiry' => '2030-01-01',
            'emergency_contact_name' => 'EC',
            'emergency_contact_phone' => '+1 555 7777',
            'pickup_date' => now()->subDays(5),
            'return_date' => now()->addDays(5),
            'vehicle_preference' => 'luxury',
            'hotel_name' => 'Hotel',
            'status' => 'completed',
        ]);

        $agreement = Agreement::create([
            'registration_id' => $reg->id,
            'vehicle_id' => $vehicle->id,
            'user_id' => $this->admin->id,
            'agreement_number' => 'AGR-2026-PDF1',
            'pickup_date' => $reg->pickup_date,
            'return_date' => $reg->return_date,
            'daily_rate' => 120,
            'total_cost' => 1200,
            'deposit_amount' => 500,
            'insurance_option' => 'premium',
            'insurance_cost' => 250,
            'current_step' => 8,
            'section_1_confirmed' => true,
            'section_2_confirmed' => true,
            'section_3_confirmed' => true,
            'section_3_initials' => 'PT',
            'section_4_confirmed' => true,
            'section_4_initials' => 'PT',
            'section_5_confirmed' => true,
            'section_5_initials' => 'PT',
            'section_6_confirmed' => true,
            'section_6_initials' => 'PT',
            'section_7_confirmed' => true,
            'section_7_initials' => 'PT',
            'sole_driver' => true,
            'signature' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==',
            'signed_at' => now()->subDay(),
            'status' => 'signed',
        ]);

        $this->actingAs($this->admin)
            ->get("/dashboard/agreements/{$agreement->id}/pdf")
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/pdf');
    }
}
