<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditorialContentToolsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_editor_can_open_article_editor_and_preview(): void
    {
        $category = Category::create(['name' => 'Berita Editor', 'slug' => 'berita-editor']);
        $editor = $this->createUser('editor-tools', 'editor');
        $article = Article::create([
            'title' => 'Artikel Pratinjau',
            'content' => 'Isi pratinjau.',
            'category_id' => $category->id,
            'author_id' => $editor->id,
            'status' => 'draft',
        ]);

        $this->actingAs($editor)
            ->get(route('admin.articles.edit', $article))
            ->assertOk()
            ->assertSee('Pilih gambar dari Media Library')
            ->assertSee('name="slug"', false);

        $this->get(route('admin.articles.preview', $article))
            ->assertOk()
            ->assertSee('Artikel Pratinjau')
            ->assertSee('Isi pratinjau.');
    }

    public function test_editor_can_manage_videos_and_public_video_pages_show_only_active_videos(): void
    {
        $editor = $this->createUser('video-editor', 'editor');

        $this->actingAs($editor)
            ->get(route('admin.videos.index'))
            ->assertOk()
            ->assertSee('Tambah Video');

        $this->post(route('admin.videos.store'), [
            'title' => 'Video Sehat',
            'youtube_id' => 'abcdefghijk',
            'is_active' => '1',
        ])->assertRedirect(route('admin.videos.index'));

        $video = Video::where('title', 'Video Sehat')->firstOrFail();
        $this->get(route('videos.index'))->assertOk()->assertSee('Video Sehat');
        $this->get(route('videos.show', $video->slug))->assertOk()->assertSee('Video Sehat');

        $video->update(['is_active' => false]);
        $this->get(route('videos.index'))->assertDontSee('Video Sehat');
        $this->get(route('videos.show', $video->slug))->assertNotFound();
    }

    public function test_video_id_is_validated_and_authors_cannot_manage_videos_or_media(): void
    {
        $editor = $this->createUser('video-validation', 'editor');

        $this->actingAs($editor)
            ->from(route('admin.videos.create'))
            ->post(route('admin.videos.store'), [
                'title' => 'ID Tidak Valid',
                'youtube_id' => 'invalid',
            ])
            ->assertSessionHasErrors('youtube_id');

        $author = $this->createUser('tools-author', 'author');
        $this->actingAs($author)
            ->get(route('admin.videos.index'))
            ->assertForbidden();
        $this->get(route('admin.media.index'))->assertForbidden();
    }

    public function test_media_library_allows_removing_unused_images_but_protects_referenced_images(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('articles/used.webp', 'used');
        Storage::disk('public')->put('articles/unused.webp', 'unused');

        $category = Category::create(['name' => 'Media', 'slug' => 'media-category']);
        $editor = $this->createUser('media-editor', 'editor');
        Article::create([
            'title' => 'Artikel Media',
            'content' => 'Isi.',
            'category_id' => $category->id,
            'author_id' => $editor->id,
            'featured_image' => 'articles/used.webp',
            'status' => 'draft',
        ]);

        $this->actingAs($editor)
            ->get(route('admin.media.index', ['select' => 1]))
            ->assertOk()
            ->assertSee('Sisipkan ke artikel');

        $this->delete('/admin/media/articles/used.webp')->assertStatus(409);
        $this->delete('/admin/media/articles/unused.webp')->assertRedirect();
        Storage::disk('public')->assertExists('articles/used.webp');
        Storage::disk('public')->assertMissing('articles/unused.webp');
    }

    public function test_rubric_categories_exist_for_the_supported_sections(): void
    {
        foreach (['pharmacy', 'medical-devices', 'people', 'digital-cover'] as $slug) {
            $this->assertDatabaseHas('categories', ['slug' => $slug]);
            $this->get(route('rubrics.show', $slug))->assertOk();
        }
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
