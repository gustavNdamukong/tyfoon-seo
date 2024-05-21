<?php

namespace Gustocoder\TyfoonSeo\Http\Controllers;


use App\Http\Controllers\Controller;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo_global;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo;
use Illuminate\Http\Request;


/**
 * Class TyfoonSeoController
 *
 * @package Gustocoder\TyfoonSeo
 * @author Gustav Ndamukong
 */
class TyfoonSeoController extends Controller
{

    private $seo;

    private $seo_global;



    public function __construct(Tyfoon_seo $tyfoonSeo, Tyfoon_seo_global $tyfoonSeoGlobal)
    {
        $this->seo = $tyfoonSeo;
        $this->seo_global = $tyfoonSeoGlobal;
    }



    public function index()
    { 
        $seoData = $this->seo::all();
        $globalSeoData = $this->seo_global::all();
        $globalSeoDataset = ($globalSeoData ? $globalSeoData : []);
        $seoDataset = ($seoData ? $seoData : []);

        return view(
            'tyfoon-seo::index', 
            ['globalDataSet' => $globalSeoDataset, 'seoData' => $seoDataset]);
    }



    public function addGlobal()
    {
        return view('tyfoon-seo::addGlobal');
    }


    public function saveNewGlobal(Request $request) 
    {
        $requestArray = $request->all();

        unset($requestArray['_token']);
        if (trim(implode('', $requestArray)) == "")
        {
            return redirect()->back()->with('danger', 'Please complete the form!');
        } 

        //field-specific validation rules
        $request->validate([
            "seo_global_geo_placename" =>           'required',
            "seo_global_geo_region" =>              'required',
            "seo_global_geo_position" =>            'required',
            "seo_global_reflang_alternate1" =>      'required',
            "seo_global_reflang_alternate2" =>      'required',
            "seo_global_og_locale" =>               'required',
            "seo_global_og_site" =>                 'required',
            "seo_global_og_article_publisher" =>    'required',
            "seo_global_og_author" =>               'required',
            "seo_global_fb_id" =>                   'required',
            "seo_global_twitter_card" =>            'required',
            "seo_global_twitter_site" =>            'required',
        ]);

        $this->seo_global->geo_placename         = $request->seo_global_geo_placename;
        $this->seo_global->geo_region            = $request->seo_global_geo_region;
        $this->seo_global->geo_position          = $request->seo_global_geo_position;
        $this->seo_global->reflang_alternate1    = $request->seo_global_reflang_alternate1;
        $this->seo_global->reflang_alternate2    = $request->seo_global_reflang_alternate2;
        $this->seo_global->og_locale             = $request->seo_global_og_locale;
        $this->seo_global->og_site               = $request->seo_global_og_site;
        $this->seo_global->og_article_publisher  = $request->seo_global_og_article_publisher;
        $this->seo_global->og_author             = $request->seo_global_og_author;
        $this->seo_global->fb_id                 = $request->seo_global_fb_id;
        $this->seo_global->twitter_card          = $request->seo_global_twitter_card;
        $this->seo_global->twitter_site          = $request->seo_global_twitter_site;

        $saved = $this->seo_global->save();

        if ($saved)
        {
            return redirect()->route('seo-home')->with('success', 'The new global SEO data was created');
        }
        else
        {
            return redirect()->back()->with('danger', 'Model new global SEO data could not be created');
        } 
    }



    public function viewGlobal($globalId)
    {
        $globalSeoData = $this->seo_global::find($globalId);
        return view('tyfoon-seo::globalDetail', ['globalData' => $globalSeoData]);
    }


    public function editGlobal($globalId)
    {
        $globalSeoData = $this->seo_global::find($globalId);
        return view('tyfoon-seo::editGlobal', ['globalData' => $globalSeoData]);
    }



    public function saveGlobalSeoEdit(Request $request)
    {
        $request->validate([
            'seo_global_id' => 'required|integer|exists:tyfoon_seo_global,id',
        ]);

        $newSeoGlobal = $this->seo_global::find($request->seo_global_id);
        $newSeoGlobal->geo_placename         = $request->seo_global_geo_placename;
        $newSeoGlobal->geo_region            = $request->seo_global_geo_region;
        $newSeoGlobal->geo_position          = $request->seo_global_geo_position;
        $newSeoGlobal->reflang_alternate1    = $request->seo_global_reflang_alternate1;
        $newSeoGlobal->reflang_alternate2    = $request->seo_global_reflang_alternate2;
        $newSeoGlobal->og_locale             = $request->seo_global_og_locale;
        $newSeoGlobal->og_site               = $request->seo_global_og_site;
        $newSeoGlobal->og_article_publisher  = $request->seo_global_og_article_publisher;
        $newSeoGlobal->og_author             = $request->seo_global_og_author;
        $newSeoGlobal->fb_id                 = $request->seo_global_fb_id;
        $newSeoGlobal->twitter_card          = $request->seo_global_twitter_card;
        $newSeoGlobal->twitter_site          = $request->seo_global_twitter_site;
        $updated = $newSeoGlobal->save(); 

        if ($updated)
        {
            return redirect()->route('seo-home')->with('success', 'The global SEO data was updated');
        }
        else
        {
            return redirect()->back()->with('danger', 'Model seo_global could not be updated');
        }                        
    }




    public function deleteGlobal(Request $request) 
    {
        $request->validate([
            'recordId' => 'required|integer|exists:tyfoon_seo_global,id',
        ]);

        $record = $this->seo_global::findOrFail($request->recordId);
        $record->delete(); 

        return redirect()->route('seo-home')->with('success', 'The global SEO record was deleted');
    }




    public function addPage()
    {
        return view('tyfoon-seo::addPage');
    }




    public function savePageSeo(Request $request)
    { 
        //The page name is the only field we make required.
        //We dont know which fields are important for your specifc target page, so we will   
        //rather not enforce anything.
        $request->validate([
            'seo_page_name' => 'required|string',
        ]);

        $this->seo->page_name               = $request->seo_page_name;
        $this->seo->meta_title_en           = $request->seo_meta_title_en;
        $this->seo->meta_title_fre          = $request->seo_meta_title_fre;
        $this->seo->meta_title_es           = $request->seo_meta_title_es;
        $this->seo->meta_desc_en            = $request->seo_meta_desc_en;
        $this->seo->meta_desc_fre           = $request->seo_meta_desc_fre;
        $this->seo->meta_desc_es            = $request->seo_meta_desc_es;
        $this->seo->dynamic                 = $request->seo_dynamic;
        $this->seo->keywords_en             = $request->seo_keywords_en;
        $this->seo->keywords_fre            = $request->seo_keywords_fre;
        $this->seo->keywords_es             = $request->seo_keywords_es;
        $this->seo->canonical_href          = $request->seo_canonical_href;
        $this->seo->no_index                = $request->seo_no_index;
        $this->seo->h1_text_en              = $request->seo_h1_text_en;
        $this->seo->h1_text_fre             = $request->seo_h1_text_fre;
        $this->seo->h1_text_es              = $request->seo_h1_text_es;
        $this->seo->h2_text_en              = $request->seo_h2_text_en;
        $this->seo->h2_text_fre             = $request->seo_h2_text_fre;
        $this->seo->h2_text_es              = $request->seo_h2_text_es;
        $this->seo->page_content_en         = $request->seo_page_content_en;
        $this->seo->page_content_fre        = $request->seo_page_content_fre;
        $this->seo->page_content_es         = $request->seo_page_content_es;
        $this->seo->og_title_en             = $request->seo_og_title_en;
        $this->seo->og_title_fre            = $request->seo_og_title_fre;
        $this->seo->og_title_es             = $request->seo_og_title_es;
        $this->seo->og_desc_en              = $request->seo_og_desc_en;
        $this->seo->og_desc_fre             = $request->seo_og_desc_fre;
        $this->seo->og_desc_es              = $request->seo_og_desc_es;
        $this->seo->og_image                = $request->seo_og_image;
        $this->seo->og_image_width          = $request->seo_og_image_width;
        $this->seo->og_image_height         = $request->seo_og_image_height;
        $this->seo->og_image_secure_url     = $request->seo_og_image_secure_url;
        $this->seo->og_type_en              = $request->seo_og_type_en;
        $this->seo->og_type_fre             = $request->seo_og_type_fre;
        $this->seo->og_type_es              = $request->seo_og_type_es;
        $this->seo->og_url                  = $request->seo_og_url;
        $this->seo->og_video                = $request->seo_og_video;
        $this->seo->twitter_title_en        = $request->seo_twitter_title_en;
        $this->seo->twitter_title_fre       = $request->seo_twitter_title_fre;
        $this->seo->twitter_title_es        = $request->seo_twitter_title_es;
        $this->seo->twitter_desc_en         = $request->seo_twitter_desc_en;
        $this->seo->twitter_desc_fre        = $request->seo_twitter_desc_fre;
        $this->seo->twitter_desc_es         = $request->seo_twitter_desc_es;
        $this->seo->twitter_image           = $request->seo_twitter_image;

        $saved = $this->seo->save();
        if ($saved)
        {
            return redirect()->route('seo-home')->with('success', 'The new SEO data was created');
        }
        else
        {
            return redirect()->back()->with('danger', 'The new SEO data could not be created');
        }
    }




    public function viewPageSeo($pageId)
    {
        $pageData = $this->seo::find($pageId);
        return view('tyfoon-seo::pageDetail', ['data' => $pageData]);
    }



    public function editPageSeo($pageId)
    {
        $pageSeoData = $this->seo::find($pageId);
        return view('tyfoon-seo::editPage', ['pageData' => $pageSeoData]);
    }



    public function savePageSeoEdit(Request $request) 
    {
        //We make two fields here mandatory; the ID field, because it's an update. 
        //We also make the page name field mandatory. Every other field is optional
        $request->validate([
            'seo_id' => 'required',
            'seo_page_name' => 'required|string',
        ]);

        $newSeo = $this->seo::find($request->seo_id);
        $newSeo->page_name               = $request->seo_page_name;
        $newSeo->meta_title_en           = $request->seo_meta_title_en;
        $newSeo->meta_title_fre          = $request->seo_meta_title_fre;
        $newSeo->meta_title_es           = $request->seo_meta_title_es;
        $newSeo->meta_desc_en            = $request->seo_meta_desc_en;
        $newSeo->meta_desc_fre           = $request->seo_meta_desc_fre;
        $newSeo->meta_desc_es            = $request->seo_meta_desc_es;
        $newSeo->dynamic                 = $request->seo_dynamic;
        $newSeo->keywords_en             = $request->seo_keywords_en;
        $newSeo->keywords_fre            = $request->seo_keywords_fre;
        $newSeo->keywords_es             = $request->seo_keywords_es;
        $newSeo->canonical_href          = $request->seo_canonical_href;
        $newSeo->no_index                = $request->seo_no_index;
        $newSeo->h1_text_en              = $request->seo_h1_text_en;
        $newSeo->h1_text_fre             = $request->seo_h1_text_fre;
        $newSeo->h1_text_es              = $request->seo_h1_text_es;
        $newSeo->h2_text_en              = $request->seo_h2_text_en;
        $newSeo->h2_text_fre             = $request->seo_h2_text_fre;
        $newSeo->h2_text_es              = $request->seo_h2_text_es;
        $newSeo->page_content_en         = $request->seo_page_content_en;
        $newSeo->page_content_fre        = $request->seo_page_content_fre;
        $newSeo->page_content_es         = $request->seo_page_content_es;
        $newSeo->og_title_en             = $request->seo_og_title_en;
        $newSeo->og_title_fre            = $request->seo_og_title_fre;
        $newSeo->og_title_es             = $request->seo_og_title_es;
        $newSeo->og_desc_en              = $request->seo_og_desc_en;
        $newSeo->og_desc_fre             = $request->seo_og_desc_fre;
        $newSeo->og_desc_es              = $request->seo_og_desc_es;
        $newSeo->og_image                = $request->seo_og_image;
        $newSeo->og_image_width          = $request->seo_og_image_width;
        $newSeo->og_image_height         = $request->seo_og_image_height;
        $newSeo->og_image_secure_url     = $request->seo_og_image_secure_url;
        $newSeo->og_type_en              = $request->seo_og_type_en;
        $newSeo->og_type_fre             = $request->seo_og_type_fre;
        $newSeo->og_type_es              = $request->seo_og_type_es;
        $newSeo->og_url                  = $request->seo_og_url;
        $newSeo->og_video                = $request->seo_og_video;
        $newSeo->twitter_title_en        = $request->seo_twitter_title_en;
        $newSeo->twitter_title_fre       = $request->seo_twitter_title_fre;
        $newSeo->twitter_title_es        = $request->seo_twitter_title_es;
        $newSeo->twitter_desc_en         = $request->seo_twitter_desc_en;
        $newSeo->twitter_desc_fre        = $request->seo_twitter_desc_fre;
        $newSeo->twitter_desc_es         = $request->seo_twitter_desc_es;
        $newSeo->twitter_image           = $request->seo_twitter_image;

        $updated = $newSeo->save(); 

        if ($updated)
        {
            return redirect()->route('seo-home')->with('success', 'The page SEO data was updated');
        }
        else
        {
            return redirect()->back()->with('danger', 'The page SEO data could not be updated');
        }
    }



    public function deletePageSeo(Request $request) 
    {
        $request->validate([
            'pageId' => 'required|integer|exists:tyfoon_seo,id',
        ]);

        $record = $this->seo::findOrFail($request->pageId);
        $page_name = $record->page_name;
        $record->delete(); 

        return redirect()->route('seo-home')->with('success', "The SEO data for ".$page_name." was deleted");
    }


    /** 
     * This method receives an AJAX call to verify & relay back to the calling
     * view code if a given page name (which should be unique) is already
     * in use or not
     */
    public function checkPageName(Request $request)
    { 
        $pageName = $request->pageName;

        $seo = $this->seo::where('page_name', $pageName)->first();

        if ($seo)
        { 
            die("<b style='color:red'>&nbsp;&larr;Sorry, a page with that name already exists</b>");
        }
        else
        { 
            //We have to return something, but because in this case we want to take no action 
            //on the form if the pageName is unique, we return a null.
            die(null);
        }
    }
}


  
	
	
	