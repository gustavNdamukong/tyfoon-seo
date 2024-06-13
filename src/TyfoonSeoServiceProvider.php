<?php

namespace Gustocoder\TyfoonSeo;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo_global;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo;
use Illuminate\Support\Facades;
use Illuminate\View\View;


class TyfoonSeoServiceProvider extends ServiceProvider
{
    private $globalSeoHTML = [];
    private $pageHeaderSeoHTML = [];
    private $pageBodySeoHTML = [];
    private $indentation = 10;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services. 
     */
    public function boot(): void
    {
        $namespace = "tyfoon-seo";
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views/', $namespace);

        //load migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tyfoon-seo-migrations');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/tyfoon-seo'),
        ], 'tyfoon-seo-public');





        if (Schema::hasTable('tyfoon_seo_global') && Schema::hasTable('tyfoon_seo')) 
        {
            //Prepare to inject SEO data into relevant views
            //Retrieve the global SEO data
            $globalSeoData = Tyfoon_seo_global::first();

            if ($globalSeoData)
            { 
                if (isset($globalSeoData->og_locale))
                { 
                    $this->globalSeoHTML[] = htmlentities('<meta property="og:locale:alternate" content="'.$globalSeoData->og_locale.'" />');
                }

                if (isset($globalSeoData->og_site))
                {
                    $this->globalSeoHTML[] = htmlentities('<meta property="og:site_name" content="'.$globalSeoData->og_site.'" />');
                }
                if (isset($globalSeoData->og_article_publisher))
                {
                    //This is the https fully qualified path to the personal/business facebook page of this site owner
                    $this->globalSeoHTML[] = htmlentities('<meta property="article:publisher" content="'.$globalSeoData->og_article_publisher.'" />');
                }
                if (isset($globalSeoData->og_author))
                {
                    //This is the https fully qualified path to the personal facebook page of this site owner 
                    $this->globalSeoHTML[] = htmlentities('<meta property="article:author" content="'.$globalSeoData->global_og_author.'" />');
                }
                if (isset($globalSeoData->geo_placename)) 
                {
                    //The example values here can be 'England', or 'London'
                    $this->globalSeoHTML[] = htmlentities('<meta name="geo.placename" content="'.$globalSeoData->geo_placename.'" />');
                }
                if (isset($globalSeoData->geo_region)) 
                {
                    //The international abbreviation for the location country eg 'UK'
                    $this->globalSeoHTML[] = htmlentities('<meta name="geo.region" content="'.$globalSeoData->geo_region.'" />');
                }
                if (isset($globalSeoData->geo_position))   
                {
                    //This will be the geo coordinates of the site location eg '7.369722;12.354722'
                    $this->globalSeoHTML[] = htmlentities('<meta name="geo.position" content="'.$globalSeoData->geo_position.'" />');
                }
                if (isset($globalSeoData->fb_id))    
                {
                    $this->globalSeoHTML[] = htmlentities('<meta property="fb:app_id" content="'.$globalSeoData->fb_id.'" />');
                }
                if (isset($globalSeoData->twitter_card))    
                {
                    //An example value could be 'summary', or 'article' etc
                    $this->globalSeoHTML[] = htmlentities('<meta name="twitter:card" content="'.$globalSeoData->twitter_card.'" />');
                }
                if (isset($globalSeoData->twitter_site))    
                {
                    //This is the ID of the Twitter account of this website
                    $this->globalSeoHTML[] = htmlentities('<meta name="twitter:site" content="'.$globalSeoData->twitter_site.'" />');  
                }
                if (isset($globalSeoData->reflang_alternate1))    
                {
                    //If your site has alternative versions in different languages. The values can be 'en-ca', or 'fr-ca' 
                    //for a Canadian site in French and English etc
                    $this->globalSeoHTML[] = htmlentities('<link rel="alternate" href="/home" hreflang="'.$globalSeoData->reflang_alternate1.'" />');
                }
                if (isset($globalSeoData->reflang_alternate2))    
                {
                    //If your site has alternative versions in different languages. The values can be 'en-ca', or 'fr-ca' 
                    //for a Canadian site in French and English etc
                    $this->globalSeoHTML[] = htmlentities('<link rel="alternate" href="/home" hreflang="'.$globalSeoData->reflang_alternate2.'" />');
                }

                //Share to all views
                //prepare array data to inject into view as a string
                Facades\View::composer('*', function (View $view) {
                    $globalSeoMetadata = $this->getGlobalSeoMetadata();
                    view()->share(
                        [
                            'globalSeoMetadata' => $globalSeoMetadata, 
                        ]);
                });
            }
        
        

            //Retrieve data of specific views for which seo data was created
            $data = Tyfoon_seo::select('page_name')->get()->toArray();

            //build that seo HTML & share it with the view
            foreach ($data as $dat)
            {
                Facades\View::composer($dat['page_name'], function (View $view) {
                    $viewName = $view->getName();
                    //Retrieve the target view's SEO data
                    $pageSeoData = Tyfoon_seo::where('page_name', $viewName)->first();

                    if ($pageSeoData)
                    {
                        $lang = config('app.locale', 'en');

                        //We only need 3 pieces of SEO data for the body section
                        $this->pageBodySeoHTML['h1_text'] = isset($pageSeoData['h1_text_'.$lang]) ? $pageSeoData['h1_text_'.$lang] : '';
                        $this->pageBodySeoHTML['h2_text'] = isset($pageSeoData['h2_text_'.$lang]) ? $pageSeoData['h2_text_'.$lang] : '';
                        $this->pageBodySeoHTML['page_content'] = isset($pageSeoData['page_content_'.$lang]) ? $pageSeoData['page_content_'.$lang] : '';
                        
                        //build the head tag SEO data
                        $descProp = 'meta_desc_'.$lang;
                        if (isset($pageSeoData->$descProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="description" content="'.$pageSeoData->$descProp.'">');
                        }

                        $keywordsProp = 'seo_keywords_'.$lang;
                        if (isset($pageSeoData->$keywordsProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="keywords" content="'.$pageSeoData->$keywordsProp.'">');
                        }

                        //OG stuff
                        $ogTitleProp = 'seo_og_title_'.$lang;
                        if (isset($pageSeoData->$ogTitleProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:title" content="'.$pageSeoData->$ogTitleProp.'" />');
                        }

                        $ogDescProp = 'seo_og_desc_'.$lang;
                        if (isset($pageSeoData->$ogDescProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:description" content="'.$pageSeoData->$ogDescProp.'" />');
                        }

                        if (isset($pageSeoData->og_image))
                        {
                            //The image fully qualified path must have been saved in this DB field
                            //instruct the user to put the fully qualified image URL in the form field. They should test in browser first to confirm
                            //that it works eg 'http://dorguzen/assets/social/site.png'
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:image" content="'.$pageSeoData->og_image.'" />');
                        }
                        if (isset($pageSeoData->og_image_secure_url))
                        {
                            //The image fully qualified path must have been saved in this DB field
                            //instruct the user to put the fully qualified image URL in the form field. They should test in browser first to confirm
                            //that it works eg: 'https://dorguzen/assets/social/site.png'
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:image:secure_url" content="'.$pageSeoData->og_image_secure_url.'" />');
                        }
                        if (isset($pageSeoData->og_image_width))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:image:width" content="'.$pageSeoData->og_image_width.'" />');
                        }
                        if (isset($pageSeoData->og_image_height))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:image:height" content="'.$pageSeoData->og_image_height.'" />');
                        }
                        if (isset($pageSeoData->og_video))
                        {
                            //Advice the user when entering this data in trhe form to provide the 'https' version of the video URL, else FB will reject it
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:video" content="'.$pageSeoData->og_video.'" />');
                        }

                        $ogTypeProp = 'og_type_'.$lang;
                        if (isset($pageSeoData->$ogTypeProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:type" content="'.$pageSeoData->$ogTypeProp.'" />');
                        }
                        if (isset($pageSeoData[0]->og_url))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta property="og:url" content="'.$pageSeoData->og_url.'" />');
                        }


                        //Twitter Card stuff
                        $twitterTitleProp = 'twitter_title_'.$lang;
                        if (isset($pageSeoData->$twitterTitleProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="twitter:title" content="'.$pageSeoData->$twitterTitleProp.'" />');
                        }  
                        
                        $twitterDescProp = 'twitter_desc_'.$lang;
                        if (isset($pageSeoData->$twitterDescProp))
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="twitter:description" content="'.$pageSeoData->$twitterDescProp.'" />');
                        } 
                        if (isset($pageSeoData->twitter_image))
                        {
                            //The fully qualified path must have been saved in this DB field
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="twitter:image" content="'.$pageSeoData->twitter_image.'" />');
                        } 
                        if (
                            (isset($pageSeoData->canonical_href)) &&
                            ($pageSeoData->canonical_href == 1)
                        )    
                        {
                            //the full qualified URL path comes from the DB, so we just insert it into the href attribute
                            $this->pageHeaderSeoHTML[] = htmlentities('<link rel="canonical" href="'.$pageSeoData->canonical_href.'" />');
                        }
                        if (
                            (isset($pageSeoData->no_index)) &&
                            ($pageSeoData->no_index == 1)
                        )    
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities('<meta name="robots" content="noindex">');
                        }

                        $titleProp = 'meta_title_' . $lang; 
                        if (isset($pageSeoData->$titleProp)) 
                        {
                            $this->pageHeaderSeoHTML[] = htmlentities("<title>".$pageSeoData->$titleProp."</title>");
                        } 
                    }

                    //prepare array data to inject into view as a string
                    $pageSeoMetadata = $this->getPageSeoMetadata();

                    view()->share(
                        [ 
                            'pageSeoMetadata'   => $pageSeoMetadata,
                            'bodySeoData'       => $this->pageBodySeoHTML
                        ]);
                });
            }
        }
    }

    public function getGlobalSeoMetadata()
	{
		$metatagHtml = '';
		foreach ($this->globalSeoHTML as $data) {
			$metatagHtml .= $this->indent() . html_entity_decode($data) . PHP_EOL; 
		}
		return $metatagHtml;
	}

    public function getPageSeoMetadata()
	{
		$metatagHtml = '';
		foreach ($this->pageHeaderSeoHTML as $data) { 
			$metatagHtml .= $this->indent() . html_entity_decode($data) . PHP_EOL;
		}
		return $metatagHtml;
	}

    private function indent()
    {
        return str_repeat(' ', $this->indentation);
    }
}
