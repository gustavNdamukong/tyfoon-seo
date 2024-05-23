<?php

namespace Gustocoder\TyfoonSeo;

use Illuminate\Support\ServiceProvider;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo_global;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class TyfoonSeoServiceProvider extends ServiceProvider
{
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
        ]);

        /*$this->publishes([
            __DIR__.'/../config/tyfoon-seo.php' => config_path('tyfoon-seo.php'),
        ]);*/

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/tyfoon-seo'),
        ], 'public');

        /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tyfoon-seo'),
        ]);*/





        //-------------PREPARE & INJECT SEO DATA INTO RELEVANT VIEWS----------------//
        //get all views for which seo data was created
        $data = Tyfoon_seo::select('page_name')->get()->toArray();
        /////$data[] = ['page_name' => 'users'];
        //echo '<pre>'; die(print_r($data));/////

        /*Facades\View::composer('*', function (View $view) {
            $viewName = $view->getName();
            die('The target view name is: '.$viewName); /////
        });*/

        //build that seo HTML & share it with the view
        /////echo '<pre> PAGE seo data: '; die(print_r($pageSeoData));/////
        $globalSeoHTML = [];
        $pageHeaderSeoHTML = [];
        $pageBodySeoHTML = [];
        foreach ($data as $dat)
        {
            //echo '<pre>'; die(print_r($dat));/////
            Facades\View::composer($dat['page_name'], function (View $view) {
                $viewName = $view->getName();
                /////die('The target view name is: '.$viewName); /////
                $globalSeoData = Tyfoon_seo_global::first(); // Retrieve the global seo data
                $pageSeoData = Tyfoon_seo::where('page_name', $viewName)->first(); // Retrieve the target view seo data

                //Gobal data
                if ($globalSeoData)
                { 
                    if (isset($globalSeoData->og_locale))
                    { 
                        $globalSeoHTML[] = '<meta property="og:locale:alternate" content="'.$globalSeoData->og_locale.'" />';
                    }
                    if (isset($globalSeoData->og_site))
                    {
                        $globalSeoHTML[] = '<meta property="og:site_name" content="'.$globalSeoData->og_site.'" />';
                    }
                    if (isset($globalSeoData->og_article_publisher))
                    {
                        //This is the https fully qualified path to the personal/business facebook page of this site owner
                        $globalSeoHTML[] = '<meta property="article:publisher" content="'.$globalSeoData->og_article_publisher.'" />';
                    }
                    if (isset($globalSeoData->og_author))
                    {
                        //This is the https fully qualified path to the personal facebook page of this site owner 
                        $globalSeoHTML[] = '<meta property="article:author" content="'.$globalSeoData->global_og_author.'" />';
                    }
                    if (isset($globalSeoData->geo_placename)) 
                    {
                        //The example values here can be 'England', or 'London'
                        $globalSeoHTML[] = '<meta name="geo.placename" content="'.$globalSeoData->geo_placename.'" />';
                    }
                    if (isset($globalSeoData->geo_region)) 
                    {
                        //The international abbreviation for the location country eg 'UK'
                        $globalSeoHTML[] = '<meta name="geo.region" content="'.$globalSeoData->geo_region.'" />';
                    }
                    if (isset($globalSeoData->geo_position))   
                    {
                        //This will be the geo coordinates of the site location eg '7.369722;12.354722'
                        $globalSeoHTML[] = '<meta name="geo.position" content="'.$globalSeoData->geo_position.'" />';
                    }
                    if (isset($globalSeoData->fb_id))    
                    {
                        $globalSeoHTML[] = '<meta property="fb:app_id" content="'.$globalSeoData->fb_id.'" />';
                    }
                    if (isset($globalSeoData->twitter_card))    
                    {
                        //An example value could be 'summary', or 'article' etc
                        $globalSeoHTML[] = '<meta name="twitter:card" content="'.$globalSeoData->twitter_card.'" />';
                    }
                    if (isset($globalSeoData->twitter_site))    
                    {
                        //This is the ID of the Twitter account of this website
                        $globalSeoHTML[] = '<meta name="twitter:site" content="'.$globalSeoData->twitter_site.'" />';  
                    }
                    if (isset($globalSeoData->reflang_alternate1))    
                    {
                        //If your site has alternative versions in different languages. The values can be 'en-ca', or 'fr-ca' 
                        //for a Canadian site in French and English etc
                        $globalSeoHTML[] = '<link rel="alternate" href="/home" hreflang="'.$globalSeoData->reflang_alternate1.'" />';
                    }
                    if (isset($globalSeoData->reflang_alternate2))    
                    {
                        //If your site has alternative versions in different languages. The values can be 'en-ca', or 'fr-ca' 
                        //for a Canadian site in French and English etc
                        $globalSeoHTML[] = '<link rel="alternate" href="/home" hreflang="'.$globalSeoData->reflang_alternate2.'" />';
                    }
                } 

                //--------------------------------------

                if ($pageSeoData)
                {
                    /*
                     [id] => 3
                    [page_name] => welcome
                    [meta_title_en] => vveveveveve
                    [meta_title_fre] => eevevevevev
                    [meta_title_es] => evevevev
                    [meta_desc_en] => eeveveve
                    [meta_desc_fre] => eevevevev
                    [meta_desc_es] => efefefefefef vefefef ecefefef efeefef
                    [dynamic] => 0
                    [og_title_en] => fefefefefe efefef. efefe
                    [og_title_fre] => fefefefefe efefef. efefe
                    [og_title_es] => fefefefefe efefef. efefe
                    [og_desc_en] => fefefefefe efefef. efefe
                    [og_desc_fre] => fefefefefe efefef. efefe
                    [og_desc_es] => fefefefefe efefef. efefe
                    [og_image] => fefefefefe efefef. efefe
                    [og_image_secure_url] => fefefefefe efefef. efefe
                    [og_image_width] => 342
                    [og_image_height] => 234
                    [og_video] => fefefefefe efefef. efefe
                    [og_type_en] => fefefefefe efefef. efefe
                    [og_type_fre] => fefefefefe efefef. efefe
                    [og_type_es] => fefefefefe efefef. efefe
                    [og_url] => fefefefefe efefef. efefe
                    [twitter_title_en] => fefefefefe efefef. efefe
                    [twitter_title_fre] => fefefefefe efefef. efefe
                    [twitter_title_es] => fefefefefe efefef. efefe
                    [twitter_desc_en] => fefefefefe efefef. efefe
                    [twitter_desc_fre] => fefefefefe efefef. efefe
                    [twitter_desc_es] => fefefefefe efefef. efefe
                    [twitter_image] => fefefefefe efefef. efefe
                    [canonical_href] => fefefefefe efefef. efefe
                    [no_index] => 0
                    [h1_text_en] => fefefefefe efefef. efefe
                    [h1_text_fre] => fefefefefe efefef. efefe
                    [h1_text_es] => fefefefefe efefef. efefe
                    [h2_text_en] => fefefefefe efefef. efefe
                    [h2_text_fre] => fefefefefe efefef. efefe
                    [h2_text_es] => fefefefefe efefef. efefe
                    [page_content_en] => fefefefefe efefef. efefe fefefefefe efefef. efefe fefefefefe efefef. efefe fefefefefe efefef. efefe
                    [page_content_fre] => fefefefefe efefef. efefe fefefefefe efefef. efefe fefefefefe efefef. efefe
                    [page_content_es] => fefefefefe efefef. efefe fefefefefe efefef. efefe fefefefefe efefef. efefe
                    [keywords_en] => fefefefefe efefef. efefe evefeffewew brtyjyj
                    [keywords_fre] => fefefefefe efefef. efefe evefeffewew brtyjyj
                    [keywords_es] => fefefefefe efefef. efefe evefeffewew brtyjyj
                    [created_at] => 2017-12-05 00:00:00
                    [updated_at] => 2017-12-05 00:00:00
                    */
                    
                    $lang = config('app.locale', 'en');

                    /*
                    There are some bits which we cannot inject into the header of the target web page, like h1 text, h2 text, page_content etc.
                    We will therefore create a new pair of getter/setter properties on this controller for these. We could call then eg bodySeoData. 
                    We will also create the equivalent of these members on the layout object too. Down in the display() method of this controller where 
                    the content of this getMetatag() method is being retrieved to be passed to the setMetadata() method of the layout class, we will also 
                    call these getBodySeoData() method to pass through the SEO data for the web page body. These bodySeoData getter & setter properties 
                    will be passed a simple associative array holding these values. Once in the view layout, they will then be available on the layout class
                    to be called so their data is output to the relevant spots on the page body. 
                    */

                    //We only need 3 pieces of SEO data for the body section
                    $pageBodySeoHTML['h1_text'] = isset($pageSeoData[0]['h1_text_'.$lang]) ? $pageSeoData[0]['h1_text_'.$lang] : '';
                    $pageBodySeoHTML['h2_text'] = isset($pageSeoData[0]['h2_text_'.$lang]) ? $pageSeoData[0]['h2_text_'.$lang] : '';
                    $pageBodySeoHTML['page_content'] = isset($pageSeoData[0]['page_content_'.$lang]) ? $pageSeoData[0]['page_content_'.$lang] : '';
                    //--------------------------------------
                    
                    //build the head tag SEO data
                    $descProp = 'meta_desc_'.$lang;
                    if (isset($pageSeoData->$descProp))
                    {/////die('PUT AM NO FEAR OOH');
                        $pageHeaderSeoHTML[] = '<meta name="description" content="'.$pageSeoData->$descProp.'">';
                    }

                    //todo: see why $pageHeaderSeoHTML is coming up with nothing in it even in the view 
                    echo '<pre> META_DESC IS: ';
                    //die($pageSeoData->$descProp);/////
                    die(print_r($pageHeaderSeoHTML));/////

                    $keywordsProp = 'seo_keywords_'.$lang;
                    if (isset($pageSeoData->$keywordsProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta name="keywords" content="'.$pageSeoData->$keywordsProp.'">';
                    }

                    //OG stuff
                    $ogTitleProp = 'seo_og_title_'.$lang;
                    if (isset($pageSeoData->$ogTitleProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:title" content="'.$pageSeoData->$ogTitleProp.'" />';
                    }

                    $ogDescProp = 'seo_og_desc_'.$lang;
                    if (isset($pageSeoData->$ogDescProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:description" content="'.$pageSeoData->$ogDescProp.'" />';
                    }

                    if (isset($pageSeoData->og_image))
                    {
                        //TODO: It depends on how the path is saved in this DB field, we may have to append that to the root path string here
                        //instruct the user to put the fully qualified image URL in the form field. They should test in browser first to confirm
                        //sp that it would just work here eg 'http://dorguzen/assets/social/site.png'
                        $pageHeaderSeoHTML[] = '<meta property="og:image" content="'.$pageSeoData->og_image.'" />';
                    }
                    if (isset($pageSeoData->og_image_secure_url))
                    {
                        //TODO: It depends on how the path is saved in this DB field, we may have to append that to the root path string here
                        //instruct the user to put the fully qualified image URL in the form field. They should test in browser first to confirm
                        //sp that it would just work here eg: 'https://dorguzen/assets/social/site.png'
                        $pageHeaderSeoHTML[] = '<meta property="og:image:secure_url" content="'.$pageSeoData->og_image_secure_url.'" />';
                    }
                    if (isset($pageSeoData->og_image_width))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:image:width" content="'.$pageSeoData->og_image_width.'" />';
                    }
                    if (isset($pageSeoData->og_image_height))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:image:height" content="'.$pageSeoData->og_image_height.'" />';
                    }
                    if (isset($pageSeoData->og_video))
                    {
                        //Advice the user when entering this data in trhe form to provide the 'https' version of the video URL, else FB will reject it
                        $pageHeaderSeoHTML[] = '<meta property="og:video" content="'.$pageSeoData->og_video.'" />';
                    }

                    $ogTypeProp = 'og_type_'.$lang;
                    if (isset($pageSeoData->$ogTypeProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:type" content="'.$pageSeoData->$ogTypeProp.'" />';
                    }
                    if (isset($pageSeoData[0]->og_url))
                    {
                        $pageHeaderSeoHTML[] = '<meta property="og:url" content="'.$pageSeoData->og_url.'" />';
                    }


                    //Twitter Card stuff
                    $twitterTitleProp = 'twitter_title_'.$lang;
                    if (isset($pageSeoData->$twitterTitleProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta name="twitter:title" content="'.$pageSeoData->$twitterTitleProp.'" />';
                    }  
                    
                    $twitterDescProp = 'twitter_desc_'.$lang;
                    if (isset($pageSeoData->$twitterDescProp))
                    {
                        $pageHeaderSeoHTML[] = '<meta name="twitter:description" content="'.$pageSeoData->$twitterDescProp.'" />';
                    } 
                    if (isset($pageSeoData->twitter_image))
                    {
                        //TODO: It depends on how the path is saved in this DB field, we may have to append that to the root path string here
                        $pageHeaderSeoHTML[] = '<meta name="twitter:image" content="'.$pageSeoData->twitter_image.'" />';
                    } 
                    if (
                        (isset($pageSeoData->canonical_href)) &&
                        ($pageSeoData->canonical_href == 1)
                    )    
                    {
                        //the full qualified URL path comes from the DB, so we just insert it into the href attribute
                        $pageHeaderSeoHTML[] = '<link rel="canonical" href="'.$pageSeoData->canonical_href.'" />';
                    }
                    if (
                        (isset($pageSeoData->no_index)) &&
                        ($pageSeoData->no_index == 1)
                    )    
                    {
                        /////$pageHeaderSeoData[0]['seo_canonical_href'] = '<meta name="robots" content="noindex">';
                        $pageHeaderSeoHTML[] = '<meta name="robots" content="noindex">';
                    }

                    ///// {} braces in stringe deprecated since PHP 7.4 so fix this
                    $titleProp = 'meta_title_' . $lang; 
                    if (isset($pageSeoData->$titleProp)) 
                    {
                        $pageHeaderSeoHTML[] = "<title>".$pageSeoData->$titleProp."</title>";
                    } 
                }

                echo '<pre>'; die(print_r($pageHeaderSeoHTML));/////
                //Share the SEO data with the view
                view()->share(['globalSeoMetadata' => $globalSeoHTML, 'pageSeoMetadata' => $pageHeaderSeoHTML]);
            });
            /////echo '<pre>'; die($viewName['page_name']);/////
        }
        // Pass seo metadata to the view
        /////view()->share(['globalSeoMetadata' => $globalSeoMetadata, 'pageSeoMetadata' => $pageSeoMetadata]);
        /////die('NO VIEW SET HERE');/////
        //-------------------------------------------------------------------------//
    }
}
