<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function カテゴリは複数のお問い合わせを取得できる(): void
    {
        $category = Category::create(['content' => 'テストカテゴリ']);
        $contacts = Contact::factory()->count(3)->create([
            'category_id' => $category->id,
        ]);

        $response = $category->fresh()->contacts;

        $this->assertCount(3, $response);
        foreach ($contacts as $contact) {
            $this->assertTrue($response->contains($contact));
        }
    }
}
