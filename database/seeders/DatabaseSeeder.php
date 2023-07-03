<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;



use Database\Seeders\config\AmenitySeeder;
use Database\Seeders\config\AmenityTranslationSeeder;
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
        $this->call(UsersTableSeeder::class);
        $this->call(MetaTagSeeder::class);
        $this->call(MetaTagTranslationsTableSeeder::class);
        $this->call(AmenitySeeder::class);
        $this->call(AmenityTranslationSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(UploadFilterSizeSeeder::class);

    }
}
