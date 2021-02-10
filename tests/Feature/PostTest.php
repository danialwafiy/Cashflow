<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Event;

class PostTest extends TestCase
{

    use RefreshDatabase;
    
    public function test_only_logged_in_users_can_see_post_list()
    {
        $response = $this->get('/posts')->assertRedirect('/login');
    }

    public function test_logged_in_users_cann_see_post_list()
    {
        Event::fake();

        $this->actingAs(User::factory()->create());
        $response = $this->get('/posts')->assertOk();
    }

    public function test_a_post_can_be_created_through_the_form()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        
        $this->actingAs(User::factory()->create());

        $response = $this->post('/posts',[
            'title' => 'Test title',
            'detail' => 'Test detail'
        ]);

        $this->assertCount(1,Post::all());
    }
}
