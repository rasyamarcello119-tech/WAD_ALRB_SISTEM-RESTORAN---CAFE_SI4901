<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing']) || Menu::exists()) {
            return;
        }

        $admin = User::where('role', User::ROLE_ADMIN)->first();

        if (! $admin) {
            return;
        }

        $menus = [
            ['Nasi Ayam Kemangi', 'Makanan', 29000, 'Ayam tumis kemangi dengan nasi hangat.', 'Kedelai', 'Halal'],
            ['Mi Babi Panggang', 'Makanan', 38000, 'Mi gandum dengan irisan babi panggang.', 'Gandum, telur', 'Non-Halal'],
            ['Es Teh Lemon', 'Minuman', 15000, 'Teh hitam dingin dengan perasan lemon.', 'Tanpa alergen utama', 'Halal'],
            ['Latte Pandan', 'Minuman', 24000, 'Espreso, susu, dan sirup pandan.', 'Susu', 'Halal'],
            ['Roti Keju Panggang', 'Camilan', 22000, 'Roti panggang dengan keju leleh.', 'Gandum, susu', 'Halal'],
            ['Pisang Gula Aren', 'Camilan', 18000, 'Pisang panggang dengan siraman gula aren.', 'Tanpa alergen utama', 'Halal'],
        ];

        DB::transaction(function () use ($menus, $admin): void {
            foreach ($menus as [$nama, $kategori, $harga, $deskripsi, $alergen, $halal]) {
                $menu = new Menu(compact('nama', 'kategori', 'harga', 'deskripsi', 'alergen', 'halal'));
                $menu->creator()->associate($admin);
                $menu->save();
            }
        });
    }
}
