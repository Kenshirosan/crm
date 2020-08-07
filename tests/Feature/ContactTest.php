<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Employee;
use App\Role;
use App\Ability;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
//    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_employee()
    {
        factory(Employee::class, 1)->create();
        factory(Role::class, 1)->create();
        factory(Ability::class, 1)->create();
        $emp = Employee::first();
        $this->assertDatabaseHas('employees', [
            'email' => $emp->email,
        ]);

        return $emp;
    }

    /** @test */
    public function it_creates_an_owner()
    {
        $emp = $this->it_creates_an_employee();
        $emp['email'] = 'l.neveux@icloud.com';
        $role = Role::first();
        $role['name'] = 'admin';
        $role->save();
        $ability = Ability::first();
        $ability->name = 'edit_user';
        $ability->save();
        $role->allowTo($ability);
        $emp->assignRole($role);
        $emp->save();
        $this->assertDatabaseHas('employees', [
            'email' => 'l.neveux@icloud.com',
        ]);

        return $emp;
    }

    /** @test */
    public function it_creates_an_employee_allowed_to_edit_users()
    {
        $emp = $this->it_creates_an_employee();

        $role = Role::first();
        $role['name'] = 'employee';
        $role->save();
        $ability = Ability::first();
        $ability->name = 'edit_user';
        $ability->label = 'edit';
        $ability->save();
        $role->allowTo($ability);
        $emp->assignRole($role);
        $emp->save();
        $this->assertDatabaseHas('employees', [
            'email' => $emp->email,
        ]);
        return $emp;
    }

    public function it_creates_an_employee_allowed_to_see_users()
    {
        $emp = $this->it_creates_an_employee();

        $role = Role::first();
        $role['name'] = 'employee';
        $role->save();
        $ability = Ability::first();
        $ability->name = 'see_user';
        $ability->label = 'see';
        $ability->save();
        $role->allowTo($ability);
        $emp->assignRole($role);
        $emp->save();
        $this->assertDatabaseHas('employees', [
            'email' => $emp->email,
        ]);
        return $emp;
    }

    /** @test */
    public function an_owner_can_do_anything()
    {
        $owner = $this->it_creates_an_owner();

        $this->assertTrue($owner->isOwner());
    }

    /** @test */
    public function employees_must_be_allowed()
    {
        $emp = $this->it_creates_an_employee();

        $this->actingAs($emp);

        $response = $this->get('/user/1');

        $response->assertStatus(403);

        $response = $this->get('/user/1');

        $response->assertStatus(403);
    }

    /** @test */
    public function employees_must_be_allowed_to_edit_users()
    {
        factory(User::class, 5)->create();
        $emp = $this->it_creates_an_employee_allowed_to_edit_users();

        $this->actingAs($emp);

        $response = $this->get('/user/1');

        $response->assertStatus(200);
    }

    /** @test */
    public function employees_must_be_allowed_to_see_users()
    {
        factory(User::class, 5)->create();
        $emp = $this->it_creates_an_employee_allowed_to_see_users();
        $user = User::first();
        $this->actingAs($emp);

        $response = $this->get('/');

        $response->assertStatus(200);

        $this->assertEquals(1, $user->id);
    }

    /** @test */
    public function employees_must_be_logged_in()
    {
        $res = $this->get('/');

        $res->assertRedirect('/login');

        factory(User::class, 5)->create();
        $res = $this->get('/user/1');

        $res->assertRedirect('/login');
    }

}
