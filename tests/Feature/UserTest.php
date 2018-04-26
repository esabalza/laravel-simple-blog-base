<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Faker\Provider as FakerProvider;

class UserTest extends TestCase
{
    /**
     * Tries to create a user and expect the message "User created successfully"
     * @return void
     */
    public function testItCreatesAUser()
    {

        $faker = Faker::create();
        $faker->addProvider(new FakerProvider\en_US\Text($faker));

        $user = factory(User::class)->create();

        $data = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'tags' => 'Tag1 Tag2 Tag3',
            'password' => '12345678',
        ];


        $this->actingAs($user)
            ->post(route('users.store'), $data)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User created successfully');

    }

    /**
     * Tries to edit a user and expect the message "User updated successfully"
     * @return void
     */
    public function testItEditsAUser()
    {

        $faker = Faker::create();
        $faker->addProvider(new FakerProvider\en_US\Text($faker));

        $user = factory(User::class)->create();

        $data = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'tags' => 'Tag1 Tag2 Tag3',
        ];

        $this->actingAs($user)
            ->patch(route('users.update', $user->id), $data)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User updated successfully');
    }
}
