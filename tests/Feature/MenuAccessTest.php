<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class MenuAccessTest extends TestCase
{
    private const ADMIN_PASSWORD = 'admin-password-for-test';

    private const USER_PASSWORD = 'user-password-for-test';

    private const ADMIN_TOKEN = 'admin-token-only-used-in-automated-tests';

    private const USER_TOKEN = 'user-token-only-used-in-automated-tests';

    private ?string $uploadRoot = null;

    protected function tearDown(): void
    {
        if ($this->uploadRoot !== null) {
            $uploads = $this->uploadRoot.'/uploads';
            foreach (File::files($uploads) as $photo) {
                File::delete($photo->getPathname());
            }
            rmdir($uploads);
            rmdir($this->uploadRoot);
        }

        parent::tearDown();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->assertSame('sqlite', config('database.default'));
        $this->assertSame(':memory:', config('database.connections.sqlite.database'));

        config([
            'menu_demo.admin_password' => self::ADMIN_PASSWORD,
            'menu_demo.user_password' => self::USER_PASSWORD,
            'menu_demo.admin_token' => self::ADMIN_TOKEN,
            'menu_demo.user_token' => self::USER_TOKEN,
        ]);

        $this->artisan('migrate', ['--no-interaction' => true])->assertSuccessful();
        $this->seed();
    }

    public function test_seeding_twice_keeps_existing_users_and_menu_data(): void
    {
        $admin = User::where('email', 'admin@menu.test')->firstOrFail();
        $menu = Menu::firstOrFail();
        $menu->update(['harga' => 32100]);

        $this->seed();

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseCount('menu', 6);
        $this->assertSame(32100, (int) $menu->fresh()->harga);
        $this->assertTrue($menu->creator->is($admin));
        $this->assertSame(hash('sha256', self::ADMIN_TOKEN), $admin->api_token);
        $this->assertArrayNotHasKey('api_token', $admin->toArray());
    }

    public function test_guest_is_redirected_and_invalid_login_leaves_session_unauthenticated(): void
    {
        $this->get('/menu')->assertRedirect('/login');
        $this->get('/login')->assertOk()->assertSee('Masuk');
        $this->post('/login', ['email' => 'admin@menu.test', 'password' => 'incorrect'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_visitor_can_read_but_receives_403_on_menu_management_routes(): void
    {
        $this->post('/login', ['email' => 'user@menu.test', 'password' => self::USER_PASSWORD])
            ->assertRedirect('/menu');
        $this->get('/login')->assertRedirect('/menu');
        $this->get('/menu')->assertOk()->assertSee('Nasi Ayam Kemangi')->assertDontSee('tombol-ubah');
        $menu = Menu::firstOrFail();

        Log::spy();
        $this->get('/menu/create')->assertForbidden();
        Log::shouldHaveReceived('info')->with('Permintaan buku menu', [
            'method' => 'GET', 'path' => 'menu/create', 'user_id' => User::where('email', 'user@menu.test')->value('id'), 'status' => 403,
        ])->once();
        $this->post('/menu', $this->menuData())->assertForbidden();
        $this->get('/menu/'.$menu->id.'/edit')->assertForbidden();
        $this->put('/menu/'.$menu->id, $this->menuData())->assertForbidden();
        $this->delete('/menu/'.$menu->id)->assertForbidden();

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_admin_can_manage_menu_and_upload_replace_and_remove_a_photo(): void
    {
        $this->uploadRoot = sys_get_temp_dir().'/menu-photos-'.bin2hex(random_bytes(8));
        mkdir($this->uploadRoot.'/uploads', recursive: true);
        $this->app->usePublicPath($this->uploadRoot);

        $this->post('/login', ['email' => 'admin@menu.test', 'password' => self::ADMIN_PASSWORD])
            ->assertRedirect('/menu');
        $this->get('/menu')->assertOk()->assertSee('tombol-ubah');
        $this->post('/menu', ['harga' => -1])->assertSessionHasErrors(['nama', 'harga']);

        $this->post('/menu', $this->menuData() + ['foto' => $this->photo()])->assertRedirect('/menu');
        $menu = Menu::where('nama', 'Soto Uji')->firstOrFail();
        $photoPath = public_path('uploads/'.$menu->foto);
        $this->assertFileExists($photoPath);
        $this->assertTrue($menu->creator->isAdmin());

        $this->get('/menu/'.$menu->id.'/edit')->assertOk()->assertSee('Soto Uji');
        $this->put('/menu/'.$menu->id, ['harga' => 34000, 'foto' => $this->photo()] + $this->menuData())
            ->assertRedirect('/menu');
        $menu->refresh();
        $replacementPath = public_path('uploads/'.$menu->foto);
        $this->assertFileDoesNotExist($photoPath);
        $this->assertFileExists($replacementPath);
        $this->assertSame(34000, (int) $menu->harga);

        $this->delete('/menu/'.$menu->id)->assertRedirect('/menu');
        $this->assertModelMissing($menu);
        $this->assertFileDoesNotExist($replacementPath);
    }

    public function test_api_enforces_token_and_role_and_exposes_menu_crud_as_json(): void
    {
        $path = '/api/v1/menu';
        $this->getJson($path)->assertUnauthorized();
        $this->getJson($path.'/9999')->assertUnauthorized();
        $this->withToken(self::USER_TOKEN)->getJson($path)->assertOk()->assertJsonCount(6, 'data');
        $this->postJson($path, $this->menuData())->assertForbidden();

        $this->withToken(self::ADMIN_TOKEN)->postJson($path, ['harga' => -1])
            ->assertUnprocessable()->assertJsonValidationErrors(['nama', 'harga']);
        $response = $this->postJson($path, $this->menuData())->assertCreated()->assertJsonPath('data.nama', 'Soto Uji');
        $itemPath = $path.'/'.$response->json('data.id');
        $this->getJson($itemPath)->assertOk()->assertJsonPath('data.harga', 29000);
        $this->patchJson($itemPath, ['harga' => 35000])->assertOk()->assertJsonPath('data.harga', 35000);
        $this->deleteJson($itemPath)->assertNoContent();
        $this->getJson($itemPath)->assertNotFound();
    }

    /** @return array{nama: string, kategori: string, harga: int, deskripsi: string, halal: string} */
    private function menuData(): array
    {
        return ['nama' => 'Soto Uji', 'kategori' => 'Makanan', 'harga' => 29000, 'deskripsi' => 'Soto ayam.', 'halal' => 'Halal'];
    }

    private function photo(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('soto.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+j/9sAAAAASUVORK5CYII='
        ));
    }
}
