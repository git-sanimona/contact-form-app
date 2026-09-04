<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 中間テーブルを介して、1つのタグが複数のお問い合わせに紐づいている(): void
    {
        $tag = Tag::factory()->create();
        $contacts = Contact::factory()->count(2)->create();

        $tag->contacts()->attach($contacts->pluck('id'));

        $response = $tag->fresh()->contacts;

        $this->assertCount(2, $response);
        foreach ($contacts as $contact) {
            $this->assertTrue($response->contains($contact));
        }
    }
}
