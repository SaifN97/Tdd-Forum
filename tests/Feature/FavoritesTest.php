<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTests extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function guests_cannot_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }



    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->post('/replies/' . $reply->id . '/favorites/');

        $this->assertCount(1, $reply->favorites);
    }


    /** @test */
    public function an_authenticated_user_may_only_favotrite_a_reply_once()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->post('/replies/' . $reply->id . '/favorites/');
        $this->post('/replies/' . $reply->id . '/favorites/');

        $this->assertCount(1, $reply->favorites);
    }
}
