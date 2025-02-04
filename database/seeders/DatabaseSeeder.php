<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'josedavid',
            'email' => 'josezondaw@gmail.com',
            'password' => Hash::make('rizosbeys@2005'),
            'rol' => 'AM'
        ]);


        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $createPost = Permission::create(['name' => 'create post']);
        $editPost = Permission::create(['name' => 'edit post']);
        $deletePost = Permission::create(['name' => 'delete post']);
        $admin->givePermissionTo($createPost, $editPost, $deletePost);
        $editor->givePermissionTo($editPost);

    }
}



