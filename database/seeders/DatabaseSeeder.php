<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Database\Seeders\admin\AdminUserSeeder;
use Database\Seeders\admin\PermissionSeeder;
use Database\Seeders\admin\RoleSeeder;
use Database\Seeders\config\AmenitySeeder;
use Database\Seeders\config\AmenityTranslationSeeder;
use Database\Seeders\config\DefPhotoSeeder;
use Database\Seeders\config\MetaTagSeeder;
use Database\Seeders\config\MetaTagTranslationsTableSeeder;
use Database\Seeders\config\SettingsTableSeeder;
use Database\Seeders\config\SettingsTranslationsTableSeeder;
use Database\Seeders\config\UploadFilterSeeder;
use Database\Seeders\config\UploadFilterSizeSeeder;
use Database\Seeders\config\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call(SettingsTableSeeder::class);
        $this->call(SettingsTranslationsTableSeeder::class);
        $this->call(MetaTagSeeder::class);
        $this->call(MetaTagTranslationsTableSeeder::class);
        $this->call(AmenitySeeder::class);
        $this->call(AmenityTranslationSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(UploadFilterSizeSeeder::class);
        $this->call(DefPhotoSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CategoryTranslationSeeder::class);

    }
}
