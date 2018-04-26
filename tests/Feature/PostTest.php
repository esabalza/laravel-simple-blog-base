<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Faker\Provider as FakerProvider;

class PostTest extends TestCase
{
    /**
     * Tries to create a post and expect the message "Post created successfully"
     * @return void
     */
    public function testItCreatesAPost()
    {

        $faker = Faker::create();
        $faker->addProvider(new FakerProvider\en_US\Text($faker));

        $user = factory(User::class)->create();

        $data = [
            'title' => $faker->text(80),
            'tags' => 'Tag1 Tag2 Tag3'
        ];


        $this->actingAs($user)
            ->post(route('posts.store'), $data)
            ->assertRedirect(route('posts.index'))
            ->assertSessionHas('success', 'Post created successfully');

    }

    /**
     * Tries to edit a post
     * @return void
     */
    public function testItEditsAPost()
    {

        $faker = Faker::create();
        $faker->addProvider(new FakerProvider\en_US\Text($faker));

        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $data = [
            'title' => $faker->text(80),
            'tags' => 'Tag1 Tag2 Tag3'
        ];


       $this->actingAs($user)
            ->patch(route('posts.update', $post->id), $data)
            ->assertRedirect(route('posts.index'))
            ->assertSessionHas('success', 'Post updated successfully');

    }
}
