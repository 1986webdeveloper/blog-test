<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method_returns_view_with_blogs()
    {
        \Artisan::call('optimize:clear');

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $blog = Blog::factory()->create(['user_id' => $user->id]);
        
        $response = $this->get('/blogs');

        $response->assertViewIs('blogs.index')
                ->assertViewHas('blogs', function ($blogs) use ($blog) {
                    return $blogs->contains($blog);
                });
    }

    public function test_create_displays_create_form()
    {
        \Artisan::call('optimize:clear');

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $response = $this->get('/blogs/create');
    
        $response->assertStatus(200);
        $response->assertSeeText('Add Blog');
    }

    public function test_store_method_creates_new_blog()
    {
        \Artisan::call('optimize:clear');
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $newFile = UploadedFile::fake()->image('new.jpg');
        $path = $newFile->store('blogs', 'public');

        $data = [
            'title' => 'My new blog',
            'body' => 'Lorem ipsum dolor sit amet',
            'user_id' => $user->id,
            'image' => $newFile,
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post('/blogs', $data);
        
        $this->assertDatabaseHas('blogs', $data); 
        Storage::disk('public')->assertExists($path);       
    }

    public function test_show_displays_single_blog()
    {
        \Artisan::call('optimize:clear');

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $blog = Blog::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/blogs/' . $blog->id);

        $response->assertStatus(200);
        $response->assertSee($blog->title);
    }

    public function test_edit_displays_edit_form()
    {
        \Artisan::call('optimize:clear');

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $blog = Blog::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/blogs/' . $blog->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Blog');
    }

    public function test_update_updates_existing_blog()
    {
        \Artisan::call('optimize:clear');
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        $blog = Blog::factory()->create(['user_id' => $user->id]);

        $newFile = UploadedFile::fake()->image('new.jpg');
        $path = $newFile->store('blogs', 'public');

        $data = [
            'title' => 'New Title',
            'body' => 'New Body',
            'user_id' => $user->id,
            'image' => $newFile,
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put('/blogs/' . $blog->id, $data);

        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => 'New Title',
            'body' => 'New Body',
            'user_id' => $user->id
        ]);

        Storage::disk('public')->assertExists($path);
    }

    public function test_destroy_deletes_blog()
    {
        \Artisan::call('optimize:clear');
        
        $user = User::factory()->create();
        $this->actingAs($user); // authenticate the user

        // create a blog to be deleted
        $blog = Blog::factory()->create(['user_id' => $user->id]);

        // Send a delete request to the destroy route
        $response = $this->delete(route('blogs.destroy', $blog));
    
        // Assert that the response redirects to the index route
        $response->assertRedirect(route('blogs.index'));
    
        // Assert that the blog post was deleted from the database
        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
    }

}
