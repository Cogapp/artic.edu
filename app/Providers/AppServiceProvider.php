<?php

namespace App\Providers;

use A17\Twill\Http\Controllers\Front\Helpers\Seo;
use A17\Twill\Models\File;
use App\Libraries\Api\Consumers\GuzzleApiConsumer;
use App\Libraries\EmbedConverterService;
use App\Libraries\LakeviewImageService;
use App\Observers\FileObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->hotfixSeoForAdminPreview();

        $this->registerMorphMap();
        $this->registerApiClient();
        $this->registerLakeviewImageService();
        $this->registerEmbedConverterService();
        $this->registerClosureService();
        $this->registerPrintService();
        $this->composeTemplatesViews();
        File::observe(FileObserver::class);

        \Illuminate\Pagination\AbstractPaginator::defaultView("site.pagination.aic");
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView("site.pagination.simple-aic");
    }

    // Taken from Front/Controller. Figure out how to make this affect Twill's ModuleController
    private function hotfixSeoForAdminPreview()
    {
        $seo = new Seo;

        $seo->title = config('twill.seo.site_title');
        $seo->description = config('twill.seo.site_desc');
        $seo->image = config('twill.seo.image');
        $seo->width = config('twill.seo.width');
        $seo->height = config('twill.seo.height');

        \View::share('seo', $seo);
    }

    public function registerMorphMap()
    {
        Relation::morphMap([
            // 'artworks' => 'App\Models\Artwork', // TODO: Fixme in db!
            'events' => 'App\Models\Event',
            'articles' => 'App\Models\Article',
            'selections' => 'App\Models\Selection',
            'artists' => 'App\Models\Artist',
            'homeFeatures' => 'App\Models\HomeFeature',

            'interactiveFeatures.experiences' => 'App\Models\Experience',

            // TODO: Figure out what to do about this rebase left-over?
            // 'digitalLabels' => 'App\Models\DigitalLabel',

            'digitalPublications' => 'App\Models\DigitalPublication',
            'printedPublications' => 'App\Models\PrintedPublication',

            'educatorResources' => 'App\Models\EducatorResource',
            'videos' => 'App\Models\Video',
            'exhibitions' => 'App\Models\Exhibition',
            'departments' => 'App\Models\Department',
            'blocks' => 'App\Models\Vendor\Block',

            'issueArticles' => 'App\Models\IssueArticle',
        ]);
    }

    public function registerApiClient()
    {
        $this->app->singleton('ApiClient', function ($app) {
            return new GuzzleApiConsumer([
                'base_uri' => config('api.base_uri'),
                'exceptions' => false,
            ]);
        });
    }

    public function registerEmbedConverterService()
    {
        $this->app->singleton('embedconverterservice', function ($app) {
            return new EmbedConverterService();
        });
    }

    public function registerLakeviewImageService()
    {
        $this->app->singleton('lakeviewimageservice', function ($app) {
            return new LakeviewImageService();
        });
    }

    public function registerClosureService()
    {
        $this->app->singleton('closureservice', function ($app) {
            return new class() {

                private $cachedClosure;

                public function __construct()
                {
                    $this->cachedClosure = \App\Models\Closure::today()->first();
                }

                public function getClosure()
                {
                    return $this->cachedClosure;
                }
            };
        });
    }

    public function registerPrintService()
    {
        $this->app->singleton('printservice', function ($app) {
            return new class() {

                private $isPrintMode;

                public function __construct()
                {
                    $this->isPrintMode = isset($_GET['print']);
                }

                public function isPrintMode()
                {
                    return $this->isPrintMode;
                }
            };
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config(['aic.version' => trim(file_get_contents(__DIR__ . '/../../VERSION'))]);
    }

    // TODO: Consider moving some of this to a config?
    private function composeTemplatesViews()
    {
        view()->composer('*', function ($view) {

            $view->with([
                '_pages' => [
                    'visit' => '/visit-us-virtually'
                    , 'hours' => route('visit') . '#hours'
                    , 'directions' => route('visit') . '#directions'

                    , 'buy' => 'https://sales.artic.edu/admissions'
                    , 'become-a-member' => 'https://sales.artic.edu/memberships'
                    , 'shop' => 'https://shop.artic.edu/'

                    , 'collection' => route('collection')
                    , 'exhibitions' => route('exhibitions')

                    , 'about-us' => '/about-us'
                    , 'about-us-inside-the-museum' => '/about-us/inside-the-museum'
                    , 'about-us-mission-history' => '/about-us/mission-and-history'
                    , 'about-us-leadership' => '/about-us/leadership'
                    , 'about-us-financials' => '/about-us/financial-reporting'
                    , 'about-us-departments' => '/about-us/departments'

                    , 'support-us' => '/support-us'
                    , 'support-us-membership' => '/support-us/membership'
                    , 'support-us-annual-fund' => '/support-us/ways-to-give/annual-fund'
                    , 'support-us-planned-giving' => '/support-us/ways-to-give/planned-giving'
                    , 'support-us-corporate-sponsorship' => '/support-us/ways-to-give/corporate-sponsorship'

                    , 'learn' => '/learn-with-us'
                    , 'learn-families' => '/learn-with-us/families'
                    , 'learn-teens' => '/learn-with-us/teens'
                    , 'learn-adults' => '/learn-with-us/adults'
                    , 'learn-educators' => '/learn-with-us/educators'

                    , 'follow-facebook' => 'https://www.facebook.com/artic'
                    , 'follow-twitter' => 'https://twitter.com/artinstitutechi'
                    , 'follow-instagram' => 'https://www.instagram.com/artinstitutechi/'
                    , 'follow-youtube' => 'https://www.youtube.com/user/ArtInstituteChicago'

                    , 'legal-articles' => route('articles')
                    , 'legal-employment' => '/employment'
                    , 'legal-venue-rental' => '/venue-rental'
                    , 'legal-contact' => '/contact'
                    , 'legal-press' => '/press'
                    , 'legal-terms' => '/terms'
                    , 'legal-image-licensing' => '/image-licensing'
                    , 'legal-saic' => 'https://www.saic.edu',
                ],
                'mobileNav' => [
                    [
                        'name' => 'Visit',
                        'slug' => route('visit'),
                    ],
                    [
                        'name' => 'Exhibition &amp; Events',
                        'children' => [
                            [
                                'name' => 'Exhibitions',
                                'slug' => route('exhibitions'),
                            ],
                            [
                                'name' => 'Events',
                                'slug' => route('events'),
                            ],
                        ],
                    ],
                    [
                        'name' => 'The Collection',
                        'slug' => route('collection'),
                        'children' => [
                            [
                                'name' => 'Artworks',
                                'slug' => route('collection'),
                            ],
                            [
                                'name' => 'Writings',
                                'slug' => route('articles_publications'),
                            ],
                            [
                                'name' => 'Resources',
                                'slug' => route('collection.research_resources'),
                            ],
                        ],
                    ],
                    [
                        'name' => 'Buy Tickets',
                        'slug' => 'https://sales.artic.edu/admissions',
                    ],
                    [
                        'name' => 'Become A Member',
                        'slug' => 'https://sales.artic.edu/memberships',
                    ],
                    [
                        'name' => 'Shop',
                        'slug' => 'https://shop.artic.edu/',
                    ],
                    [
                        'name' => 'About Us',
                        'slug' => route('genericPages.show', 'about-us'),
                    ],
                    [
                        'name' => 'Learn With Us',
                        'slug' => 'learn-with-us',
                    ],
                    [
                        'name' => 'Support Us',
                        'slug' => 'support-us',
                    ],
                ],

            ]);
        });
    }
}
