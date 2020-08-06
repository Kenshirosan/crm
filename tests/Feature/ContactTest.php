<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Employee;
use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
//    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function employees_must_be_logged_in()
    {
        factory(Employee::class, 1)->create();
        factory(Role::class, 1)->create();
        $role = Role::first();
        $role['name'] = 'admin';
        $role->save();
        $emp = Employee::first();
        $emp['email'] = 'l.neveux@icloud.com';
        $emp->save();

        $this->assertDatabaseHas('employees', [
            'email' => 'l.neveux@icloud.com',
        ]);

        $this->actingAs($emp);

        $emp->assignRole($role);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
