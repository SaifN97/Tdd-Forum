<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function a_user_can_search_threads()
    {
        config(['scout.driver' => 'algolia']);

        create('App\Thread', [], 2);
        create('App\Thread', ['body' => "A thread with foobar term."], 2);

        do {
            //Account for latency
            sleep(.50);

            $results = $this->getJson("/threads/search?q=foobar")->json()['data'];
        } while (empty($results));


        $this->assertCount(2, $results);

        //Clean up.
        Thread::latest()->take(4)->unsearchable();
    }
}
