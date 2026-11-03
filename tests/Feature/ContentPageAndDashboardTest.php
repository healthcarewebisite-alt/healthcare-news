<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContentPageAndDashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_editor_can_update_information_page_and_public_page_uses_saved_content_safely(): void
    {
        $editor = $this->createUser('pages-editor', 'editor');
        $page = ContentPage::where('slug', 'contact')->firstOrFail();

        $this->actingAs($editor)
            ->get(route('admin.pages.index'))
            ->assertOk()
            ->assertSee('Halaman Informasi')
            ->assertSee('Contact Us');

        $this->put(route('admin.pages.update', $page), [
            'title' => 'Hubungi Redaksi',
            'content' => "Kontak baru.\n\n<script>alert('x')</script>",
            'email_label' => 'Redaksi',
            'email' => 'redaksi-baru@healthcare.id',
            'address' => 'Alamat baru',
            'phone' => '+62 812-0000-0000',
        ])->assertRedirect(route('admin.pages.index'));

        $this->assertDatabaseHas('content_pages', [
            'id' => $page->id,
            'title' => 'Hubungi Redaksi',
            'email' => 'redaksi-baru@healthcare.id',
        ]);
        $this->get(route('pages.contact'))
            ->assertOk()
            ->assertSee('Hubungi Redaksi')
            ->assertSee('redaksi-baru@healthcare.id')
            ->assertSee('Alamat baru')
            ->assertSee('alert(&#039;x&#039;)', false)
            ->assertDontSee('<script>', false);
    }

    public function test_only_editors_can_manage_information_pages_and_page_fields_are_validated(): void
    {
        $page = ContentPage::where('slug', 'advertise')->firstOrFail();
        $author = $this->createUser('pages-author', 'author');

        $this->actingAs($author)
            ->get(route('admin.pages.index'))
            ->assertForbidden();

        $editor = $this->createUser('pages-validation-editor', 'editor');
        $this->actingAs($editor)
            ->from(route('admin.pages.edit', $page))
            ->put(route('admin.pages.update', $page), [
                'title' => 'Judul',
                'content' => 'Konten',
                'email' => 'bukan-email',
            ])
            ->assertSessionHasErrors('email');

        $this->assertDatabaseHas('content_pages', ['id' => $page->id, 'title' => 'Advertise']);
    }

    public function test_editor_dashboard_surfaces_review_and_pending_comment_queues(): void
    {
        $category = Category::create(['name' => 'Moderasi', 'slug' => 'moderasi']);
        $author = $this->createUser('queue-author', 'author');
        $editor = $this->createUser('queue-editor', 'editor');
        $article = Article::create([
            'title' => 'Artikel Menunggu Review',
            'content' => 'Isi.',
            'category_id' => $category->id,
            'author_id' => $author->id,
            'status' => 'in_review',
            'submitted_for_review_at' => now(),
        ]);
        Comment::create([
            'article_id' => $article->id,
            'guest_name' => 'Komentar Pending',
            'guest_email' => 'visitor@example.test',
            'body' => 'Mohon ditinjau sebelum ditampilkan.',
            'status' => 'pending',
        ]);

        $this->actingAs($editor)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Antrean Review Artikel')
            ->assertSee('Artikel Menunggu Review')
            ->assertSee('Komentar Menunggu Moderasi')
            ->assertSee('Komentar Pending')
            ->assertSee(route('admin.articles.index', ['status' => 'in_review']), false)
            ->assertSee(route('admin.comments.index', ['status' => 'pending']), false);
    }

    public function test_comment_moderation_rejects_unknown_status_filter(): void
    {
        $editor = $this->createUser('comments-filter-editor', 'editor');

        $this->actingAs($editor)
            ->get(route('admin.comments.index', ['status' => 'unknown']))
            ->assertSessionHasErrors('status');
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
}
