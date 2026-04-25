<?php

namespace Modules\Hotel\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\RoomType;
use App\Models\User;

class BookingContractTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Room $room;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        
        $roomType = RoomType::factory()->create();
        $this->room = Room::factory()->create(['room_type_id' => $roomType->id, 'status' => 'available']);
    }

    /** @test */
    public function it_returns_exact_json_structure_on_successful_booking()
    {
        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/api/v1/hotel/admin/bookings', [
                'room_id' => $this->room->id,
                'user_id' => $this->admin->id,
                'guest_name' => 'John Doe',
                'guest_email' => 'john@example.com',
                'guest_phone' => '123456789',
                'check_in_date' => now()->addDay()->toDateString(),
                'check_out_date' => now()->addDays(3)->toDateString(),
                'adults' => 2,
                'children' => 0,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'status',
                'message',
                'data' => [
                    'id',
                    'booking_reference',
                    'status',
                    'guest' => ['name', 'email', 'phone'],
                    'stay' => ['check_in', 'check_out', 'nights'],
                    'financials' => [
                        'total_amount',
                        'tax_amount',
                        'paid_amount',
                        'balance_due',
                        'currency'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_stable_validation_error_format()
    {
        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/api/v1/hotel/admin/bookings', []); // Empty body

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'status' => 'error',
                'error_code' => 'VALIDATION_ERROR'
            ])
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function it_returns_stable_auth_error_format()
    {
        $response = $this->postJson('/api/v1/hotel/admin/bookings', []);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'status' => 'error',
                'error_code' => 'UNAUTHORIZED'
            ]);
    }
}
