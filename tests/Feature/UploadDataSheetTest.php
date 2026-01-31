<?php

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('guests are redirected from uploads page', function () {
    $this->get(route('uploads.index'))->assertRedirect('/login');
});

test('authenticated users can visit uploads page', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('uploads.index'))
        ->assertOk()
        ->assertSee('Upload Data Sheet')
        ->assertSee('Required Columns')
        ->assertSee('Customer Name')
        ->assertSee('Docket Number')
        ->assertSee('Delivery Address')
        ->assertSee('Phone Number')
        ->assertSee('Pincode')
        ->assertSee('Select File');
});

test('valid csv upload creates deliveries', function () {
    $this->actingAs(User::factory()->create());
    $csv = "Customer Name,Docket Number,Delivery Address,Phone Number,Pincode\n".
        'John Doe,DOCK-001,123 Main St,9876543210,560001';

    $file = UploadedFile::fake()->createWithContent('deliveries.csv', $csv);

    $this->post(route('uploads.store'), ['file' => $file])
        ->assertRedirect(route('uploads.index'));

    expect(Delivery::count())->toBe(1);
    $delivery = Delivery::first();
    expect($delivery->customer_name)->toBe('John Doe')
        ->and($delivery->docket_number)->toBe('DOCK-001')
        ->and($delivery->address)->toBe('123 Main St')
        ->and($delivery->phone)->toBe('9876543210')
        ->and($delivery->pincode)->toBe('560001')
        ->and($delivery->status)->toBe(Delivery::STATUS_PENDING);
});

test('duplicate docket number is skipped', function () {
    $this->actingAs(User::factory()->create());
    Delivery::create([
        'docket_number' => 'DOCK-001',
        'customer_name' => 'Existing',
        'company_name' => 'Co',
        'address' => 'Addr',
        'phone' => '123',
        'status' => Delivery::STATUS_PENDING,
    ]);
    $csv = "Customer Name,Docket Number,Delivery Address,Phone Number,Pincode\n".
        'Jane Doe,DOCK-001,456 Oak Ave,9876543211,560002';

    $file = UploadedFile::fake()->createWithContent('duplicates.csv', $csv);

    $this->post(route('uploads.store'), ['file' => $file])
        ->assertRedirect(route('uploads.index'));

    expect(Delivery::count())->toBe(1);
});

test('file validation rejects invalid types', function () {
    $this->actingAs(User::factory()->create());
    $file = UploadedFile::fake()->create('document.pdf', 100);

    $this->post(route('uploads.store'), ['file' => $file])
        ->assertSessionHasErrors(['file']);
});

test('upload requires authentication', function () {
    $csv = "Customer Name,Docket Number,Delivery Address,Phone Number,Pincode\n".
        'John Doe,DOCK-001,123 Main St,9876543210,560001';
    $file = UploadedFile::fake()->createWithContent('deliveries.csv', $csv);

    $this->post(route('uploads.store'), ['file' => $file])
        ->assertRedirect('/login');
});
