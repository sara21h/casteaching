<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function users_can_view_videos()
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?v=12345',
            'published_at' => Carbon::parse('December 13, 2020'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        $video2 = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?v=12345',
            'published_at' => Carbon::parse('December 13, 2020'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        $response = $this->get('/videos/' . $video -> id);
        $response = $this->get('/videos/' . $video2 -> id);

        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('December 13');
    }
}

