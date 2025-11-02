<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Tag::create(['name' => ['en' => 'Action',        'uk' => 'Екшн'], 'slug' => 'action']);
        Tag::create(['name' => ['en' => 'Comedy',        'uk' => 'Комедія'], 'slug' => 'comedy']);
        Tag::create(['name' => ['en' => 'Drama',         'uk' => 'Драма'], 'slug' => 'drama']);
        Tag::create(['name' => ['en' => 'Thriller',      'uk' => 'Трилер'], 'slug' => 'thriller']);
        Tag::create(['name' => ['en' => 'Horror',        'uk' => 'Жахи'], 'slug' => 'horror']);
        Tag::create(['name' => ['en' => 'Romance',       'uk' => 'Романтика'], 'slug' => 'romance']);
        Tag::create(['name' => ['en' => 'Sci-Fi',        'uk' => 'Наукова фантастика'], 'slug' => 'sci-fi']);
        Tag::create(['name' => ['en' => 'Fantasy',       'uk' => 'Фентезі'], 'slug' => 'fantasy']);
        Tag::create(['name' => ['en' => 'Adventure',     'uk' => 'Пригоди'], 'slug' => 'adventure']);
        Tag::create(['name' => ['en' => 'Animation',     'uk' => 'Анімація'], 'slug' => 'animation']);
        Tag::create(['name' => ['en' => 'Crime',         'uk' => 'Кримінал'], 'slug' => 'crime']);
        Tag::create(['name' => ['en' => 'Mystery',       'uk' => 'Містика'], 'slug' => 'mystery']);
        Tag::create(['name' => ['en' => 'Documentary',   'uk' => 'Документальний'], 'slug' => 'documentary']);
        Tag::create(['name' => ['en' => 'Biography',     'uk' => 'Біографія'], 'slug' => 'biography']);
        Tag::create(['name' => ['en' => 'Musical',       'uk' => 'Мюзикл'], 'slug' => 'musical']);
        Tag::create(['name' => ['en' => 'War',           'uk' => 'Військовий'], 'slug' => 'war']);
        Tag::create(['name' => ['en' => 'Western',       'uk' => 'Вестерн'], 'slug' => 'western']);
        Tag::create(['name' => ['en' => 'Family',        'uk' => 'Сімейний'], 'slug' => 'family']);
        Tag::create(['name' => ['en' => 'History',       'uk' => 'Історичний'], 'slug' => 'history']);
        Tag::create(['name' => ['en' => 'Sport',         'uk' => 'Спорт'], 'slug' => 'sport']);
    }
}
