<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $seeders = [
        PagesTableSeeder::class,
        HoursTableSeeder::class,
        HomePageLinkSeeder::class,
        HomePageSeeder::class,
        MembershipMagazinePageSeeder::class,
        VisitPageSeeder::class,
        EmailSeriesSeeder::class,
        EventProgramSeeder::class,
        PublishStartDateSeeder::class,
        RelatedArticlesSeeder::class,
        MembershipBannerSeeder::class,
        VanityRedirectSeeder::class,
        IlluminateTagSeeder::class,
        HighlightSeeder::class,
        SlideSeeder::class,
    ];

    public function run(): void
    {
        $this->call(PagesTableSeeder::class);
        $this->call(HoursTableSeeder::class);
    }
}
