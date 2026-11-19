<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        return $this->halaman();
    }

    public function apiIndex(): AnonymousResourceCollection
    {
        return MenuResource::collection(Menu::orderBy('id')->paginate(20));
    }

    public function apiShow(Menu $menu): MenuResource
    {
        return new MenuResource($menu);
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('menu.index');
    }

    public function edit(string $id): View
    {
        return $this->halaman(Menu::findOrFail($id));
    }

    private function halaman(?Menu $menuEdit = null): View
    {
        $menus = Menu::orderBy('id')->get();
        $kategoriValid = ['Makanan', 'Minuman', 'Camilan'];
        $halalValid = ['Halal', 'Non-Halal'];
        $grupMenu = [];
        foreach ($kategoriValid as $kategori) {
            $grupMenu[$kategori] = $menus->where('kategori', $kategori)->toArray();
        }
        $isiForm = $menuEdit?->toArray() ?? ['id' => 0, 'nama' => '', 'kategori' => 'Makanan', 'harga' => '', 'deskripsi' => '', 'alergen' => '', 'halal' => 'Halal'];
        if ($isiForm['alergen'] === 'Tanpa alergen utama') {
            $isiForm['alergen'] = '';
        }
        $pesan = session('pesan');
        $fotoDefault = function (string $nama, string $kategori): string {
            $ikon = match ($kategori) {
                'Minuman' => '☕', 'Camilan' => '🍟', default => '🍽️'
            };
            $teks = htmlspecialchars(mb_substr($nama, 0, 14), ENT_XML1, 'UTF-8');

            return 'data:image/svg+xml;utf8,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120"><rect width="120" height="120" fill="#f6f0e4"/><text x="50%" y="48%" dominant-baseline="middle" text-anchor="middle" font-size="38">'.$ikon.'</text><text x="50%" y="80%" dominant-baseline="middle" text-anchor="middle" font-family="Georgia, serif" font-size="11" fill="#6d5738">'.$teks.'</text></svg>');
        };

        return view('menu.index', compact('menus', 'menuEdit', 'isiForm', 'kategoriValid', 'halalValid', 'grupMenu', 'pesan', 'fotoDefault'));
    }

    private function simpan(Request $request, Menu $menu): RedirectResponse|JsonResponse
    {
        $rules = [
            'nama' => ['required', 'string', 'max:100'], 'kategori' => ['required', 'in:Makanan,Minuman,Camilan'],
            'harga' => ['required', 'integer', 'min:0', 'max:4294967295'], 'deskripsi' => ['required', 'string', 'max:10000'],
            'alergen' => ['nullable', 'string', 'max:150'], 'halal' => ['required', 'in:Halal,Non-Halal'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ];
        $partialUpdate = $request->routeIs('api.v1.*') && $request->isMethod('PATCH');
        if ($partialUpdate) {
            $rules = array_map(fn (array $rule): array => ['sometimes', ...$rule], $rules);
        }

        $data = $request->validate($rules);
        if (! $partialUpdate || array_key_exists('alergen', $data)) {
            $data['alergen'] = ($data['alergen'] ?? '') ?: 'Tanpa alergen utama';
        }
        unset($data['foto']);
        $isNew = ! $menu->exists;
        if ($isNew) {
            $menu->creator()->associate($request->user());
        }

        $lama = $menu->foto;
        $baru = null;
        if ($request->hasFile('foto')) {
            $baru = $request->file('foto')->hashName();
            $request->file('foto')->move(public_path('uploads'), $baru);
        }
        $data['foto'] = $baru ?? $lama ?? '';
        try {
            $menu->fill($data)->save();
        } catch (\Throwable $error) {
            if ($baru) {
                File::delete(public_path('uploads/'.$baru));
            }
            throw $error;
        }
        if ($baru && $lama && $lama === basename($lama)) {
            File::delete(public_path('uploads/'.$lama));
        }

        if ($request->routeIs('api.v1.*')) {
            return (new MenuResource($menu))->response()->setStatusCode($isNew ? 201 : 200);
        }

        return redirect()->route('menu.index')->with('pesan', ['tipe' => 'sukses', 'teks' => 'Menu berhasil disimpan.']);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        return $this->simpan($request, new Menu);
    }

    public function update(Request $request, string $id): RedirectResponse|JsonResponse
    {
        return $this->simpan($request, Menu::findOrFail($id));
    }

    public function destroy(Request $request, string $id): RedirectResponse|Response
    {
        $menu = Menu::findOrFail($id);
        $foto = $menu->foto;
        $menu->delete();
        if ($foto && $foto === basename($foto)) {
            File::delete(public_path('uploads/'.$foto));
        }

        if ($request->routeIs('api.v1.*')) {
            return response()->noContent();
        }

        return redirect()->route('menu.index')->with('pesan', ['tipe' => 'sukses', 'teks' => 'Menu berhasil dihapus.']);
    }
}
