<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EditorialWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    public function test_author_cannot_access_another_authors_article(): void
    {
        $category = Category::create(['name' => 'Berita', 'slug' => 'berita']);
        $owner = $this->createUser('owner', 'author');
        $otherAuthor = $this->createUser('other-author', 'author');
        $article = $this->createArticle($category, $owner, 'draft');

        $this->actingAs($otherAuthor)
            ->get(route('admin.articles.edit', $article))
            ->assertForbidden();
    }

    public function test_author_submission_enters_review_and_editor_can_publish_it(): void
    {
        $category = Category::create(['name' => 'Berita', 'slug' => 'berita']);
        $author = $this->createUser('review-author', 'author');
        $editor = $this->createUser('review-editor', 'editor');
        $article = $this->createArticle($category, $author, 'draft');

        $this->actingAs($author)
            ->post(route('admin.articles.submit-review', $article))
            ->assertRedirect();
        $this->assertDatabaseHas('articles', ['id' => $article->id, 'status' => 'in_review']);

        $this->actingAs($editor)
            ->post(route('admin.articles.publish', $article))
            ->assertRedirect();
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'status' => 'published',
            'reviewed_by' => $editor->id,
        ]);
    }

    public function test_author_cannot_publish_through_article_update_or_review_route(): void
    {
        $category = Category::create(['name' => 'Berita', 'slug' => 'berita']);
        $author = $this->createUser('protected-author', 'author');
        $article = $this->createArticle($category, $author, 'draft');

        $this->actingAs($author)
            ->put(route('admin.articles.update', $article), [
                'title' => 'Artikel CMS',
                'content' => 'Isi artikel.',
                'category_id' => $category->id,
                'status' => 'published',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('articles', ['id' => $article->id, 'status' => 'draft']);
        $this->post(route('admin.articles.publish', $article))->assertForbidden();
        $this->get(route('admin.categories.index'))->assertForbidden();
    }

    public function test_editor_can_schedule_and_reject_articles_in_review(): void
    {
        $category = Category::create(['name' => 'Berita', 'slug' => 'berita']);
        $author = $this->createUser('workflow-author', 'author');
        $editor = $this->createUser('workflow-editor', 'editor');
        $scheduledArticle = $this->createArticle($category, $author, 'in_review', 'Artikel Terjadwal');
        $rejectedArticle = $this->createArticle($category, $author, 'in_review', 'Artikel Perlu Revisi');

        $publishAt = now()->addDay()->startOfMinute();
        $this->actingAs($editor)
            ->post(route('admin.articles.schedule', $scheduledArticle), [
                'published_at' => $publishAt->format('Y-m-d\TH:i'),
            ])
            ->assertRedirect();
        $this->assertDatabaseHas('articles', [
            'id' => $scheduledArticle->id,
            'status' => 'scheduled',
            'reviewed_by' => $editor->id,
        ]);

        $this->post(route('admin.articles.reject', $rejectedArticle), [
            'review_notes' => 'Mohon tambahkan sumber untuk klaim pada paragraf kedua.',
        ])->assertRedirect();
        $this->assertDatabaseHas('articles', [
            'id' => $rejectedArticle->id,
            'status' => 'rejected',
            'review_notes' => 'Mohon tambahkan sumber untuk klaim pada paragraf kedua.',
            'reviewed_by' => $editor->id,
        ]);
    }

    public function test_author_dashboard_only_shows_their_articles_and_hides_editor_metrics(): void
    {
        $category = Category::create(['name' => 'Berita', 'slug' => 'berita']);
        $author = $this->createUser('dashboard-author', 'author');
        $otherAuthor = $this->createUser('dashboard-other', 'author');
        $this->createArticle($category, $author, 'draft', 'Draft Milik Saya');
        $this->createArticle($category, $otherAuthor, 'draft', 'Draft Milik Penulis Lain');

        $this->actingAs($author)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Draft Milik Saya')
            ->assertDontSee('Draft Milik Penulis Lain')
            ->assertDontSee('Komentar Terbaru')
            ->assertDontSee('Rumah Sakit &amp; Dokter');
    }

    private function createUser(string $prefix, string $role): User
    {
        return User::create([
            'name' => $prefix,
            'email' => $prefix.'@example.test',
            'password' => 'password',
            'role' => $role,
            'is_active' => true,
        ]);
    }

    private function createArticle(Category $category, User $author, string $status, string $title = 'Artikel CMS'): Article
    {
        return Article::create([
            'title' => $title,
            'content' => 'Isi artikel.',
            'category_id' => $category->id,
            'author_id' => $author->id,
            'status' => $status,
        ]);
    }
}
