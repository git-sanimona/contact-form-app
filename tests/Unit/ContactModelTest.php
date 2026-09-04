<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function お問い合わせは特定のカテゴリに属し、複数のタグと同期（sync）できる(): void
    {
        $category = Category::factory()->create([
            'content' => 'テスト',
        ]);
        $contact = Contact::factory()->create([
            'category_id' => $category->id,
        ]);
        $tags = Tag::factory()->count(5)->create();

        $syncIds = $tags->take(2)->pluck('id')->toArray();
        $contact->tags()->sync($syncIds);

        $this->assertEquals($category->id, $contact->category->id);
        $this->assertEquals('テスト', $contact->category->content);

        $this->assertCount(2, $contact->fresh()->tags);
        $this->assertEqualsCanonicalizing($syncIds, $contact->fresh()->tags->pluck('id')->toArray());
    }
}
