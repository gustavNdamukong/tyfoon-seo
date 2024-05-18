<?php

namespace Gustocoder\TyfoonSeo\Http\Controllers;


use App\Http\Controllers\Controller;
/////use Illuminate\Database\Eloquent\Model;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo_global;
use Gustocoder\TyfoonSeo\Models\Tyfoon_seo;
/////use Illuminate\Support\Facades\Log;
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


    //----------------- HANDLE GLOBAL SEO DATA ----------------------------//
    public function addGlobal()
    {
        return view('tyfoon-seo::addGlobal');
    }



    public function saveNewGlobal() 
    {
        $seo_global_geo_placename = '';
        $seo_global_geo_region = '';
        $seo_global_geo_position = '';
        $seo_global_reflang_alternate1 = '';
        $seo_global_reflang_alternate2 = '';
        $seo_global_og_locale = '';
        $seo_global_og_site = '';
        $seo_global_og_article_publisher = '';
        $seo_global_og_author = '';
        $seo_global_fb_id = '';
        $seo_global_twitter_card = '';
        $seo_global_twitter_site = '';

        //The only validation we will do for this feature is a for a blank submission
        //when it comes to SEO, we dont know which fields are important to you, so we will   
        //rather not enforce anything.

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            unset($_POST['_token']);
            if (trim(implode('', $_POST)) == "")
            {
                return redirect()->back()->with('danger', 'Please complete the form!');
            } 
        }

        if (
            (isset($_POST['seo_global_geo_placename'])) &&
            ($_POST['seo_global_geo_placename'] != '')
        )
        {
            $seo_global_geo_placename = $_POST['seo_global_geo_placename'];
        }

        if (
            (isset($_POST['seo_global_geo_region'])) &&
            ($_POST['seo_global_geo_region'] != '')
        )
        {
            $seo_global_geo_region = $_POST['seo_global_geo_region'];
        }

        if (
            (isset($_POST['seo_global_geo_position'])) &&
            ($_POST['seo_global_geo_position'] != '')
        )
        {
            $seo_global_geo_position = $_POST['seo_global_geo_position']; 
        }

        if (
            (isset($_POST['seo_global_reflang_alternate1'])) &&
            ($_POST['seo_global_reflang_alternate1'] != '')
        )
        {
            $seo_global_reflang_alternate1 = $_POST['seo_global_reflang_alternate1'];
        }

        if (
            (isset($_POST['seo_global_reflang_alternate2'])) &&
            ($_POST['seo_global_reflang_alternate2'] != '')
        )
        {
            $seo_global_reflang_alternate2 = $_POST['seo_global_reflang_alternate2'];
        }

        if (
            (isset($_POST['seo_global_og_locale'])) &&
            ($_POST['seo_global_og_locale'] != '')
        )
        {
            $seo_global_og_locale = $_POST['seo_global_og_locale'];
        }

        if (
            (isset($_POST['seo_global_og_site'])) &&
            ($_POST['seo_global_og_site'] != '')
        )
        {
            $seo_global_og_site = $_POST['seo_global_og_site']; 
        }

        if (
            (isset($_POST['seo_global_og_article_publisher'])) &&
            ($_POST['seo_global_og_article_publisher'] != '')
        )
        {
            $seo_global_og_article_publisher = $_POST['seo_global_og_article_publisher'];
        } 

        if (
            (isset($_POST['seo_global_og_author'])) &&
            ($_POST['seo_global_og_author'] != '')
        )
        {
            $seo_global_og_author = $_POST['seo_global_og_author'];
        } 

        if (
            (isset($_POST['seo_global_fb_id'])) &&
            ($_POST['seo_global_fb_id'] != '')
        )
        {
            $seo_global_fb_id = $_POST['seo_global_fb_id'];
        } 

        if (
            (isset($_POST['seo_global_twitter_card'])) &&
            ($_POST['seo_global_twitter_card'] != '')
        )
        {
            $seo_global_twitter_card = $_POST['seo_global_twitter_card'];
        } 

        if (
            (isset($_POST['seo_global_twitter_site'])) &&
            ($_POST['seo_global_twitter_site'] != '')
        )
        {
            $seo_global_twitter_site = $_POST['seo_global_twitter_site'];
        }
        
        $this->seo_global->geo_placename         = $seo_global_geo_placename;
        $this->seo_global->geo_region            = $seo_global_geo_region;
        $this->seo_global->geo_position          = $seo_global_geo_position;
        $this->seo_global->reflang_alternate1    = $seo_global_reflang_alternate1;
        $this->seo_global->reflang_alternate2    = $seo_global_reflang_alternate2;
        $this->seo_global->og_locale             = $seo_global_og_locale;
        $this->seo_global->og_site               = $seo_global_og_site;
        $this->seo_global->og_article_publisher  = $seo_global_og_article_publisher;
        $this->seo_global->og_author             = $seo_global_og_author;
        $this->seo_global->fb_id                 = $seo_global_fb_id;
        $this->seo_global->twitter_card          = $seo_global_twitter_card;
        $this->seo_global->twitter_site          = $seo_global_twitter_site;

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


    public function saveGlobalSeoEdit()
    {
        $seo_global_id = '';
        $seo_global_geo_placename = '';
        $seo_global_geo_region = '';
        $seo_global_geo_position = '';
        $seo_global_reflang_alternate1 = '';
        $seo_global_reflang_alternate2 = '';
        $seo_global_og_locale = '';
        $seo_global_og_site = '';
        $seo_global_og_article_publisher = '';
        $seo_global_og_author = '';
        $seo_global_fb_id = '';
        $seo_global_twitter_card = '';
        $seo_global_twitter_site = '';

        if (
            (isset($_POST['seo_global_id'])) &&
            ($_POST['seo_global_id'] != '')
        )
        {
            $seo_global_id = $_POST['seo_global_id'];
        }

        if (
            (isset($_POST['seo_global_geo_placename'])) &&
            ($_POST['seo_global_geo_placename'] != '')
        )
        {
            $seo_global_geo_placename = $_POST['seo_global_geo_placename'];
        }

        if (
            (isset($_POST['seo_global_geo_region'])) &&
            ($_POST['seo_global_geo_region'] != '')
        )
        {
            $seo_global_geo_region = $_POST['seo_global_geo_region'];
        }

        if (
            (isset($_POST['seo_global_geo_position'])) &&
            ($_POST['seo_global_geo_position'] != '')
        )
        {
            $seo_global_geo_position = $_POST['seo_global_geo_position']; 
        }

        if (
            (isset($_POST['seo_global_reflang_alternate1'])) &&
            ($_POST['seo_global_reflang_alternate1'] != '')
        )
        {
            $seo_global_reflang_alternate1 = $_POST['seo_global_reflang_alternate1'];
        }

        if (
            (isset($_POST['seo_global_reflang_alternate2'])) &&
            ($_POST['seo_global_reflang_alternate2'] != '')
        )
        {
            $seo_global_reflang_alternate2 = $_POST['seo_global_reflang_alternate2'];
        }

        if (
            (isset($_POST['seo_global_og_locale'])) &&
            ($_POST['seo_global_og_locale'] != '')
        )
        {
            $seo_global_og_locale = $_POST['seo_global_og_locale'];
        }

        if (
            (isset($_POST['seo_global_og_site'])) &&
            ($_POST['seo_global_og_site'] != '')
        )
        {
            $seo_global_og_site = $_POST['seo_global_og_site']; 
        }

        if (
            (isset($_POST['seo_global_og_article_publisher'])) &&
            ($_POST['seo_global_og_article_publisher'] != '')
        )
        {
            $seo_global_og_article_publisher = $_POST['seo_global_og_article_publisher'];
        } 

        if (
            (isset($_POST['seo_global_og_author'])) &&
            ($_POST['seo_global_og_author'] != '')
        )
        {
            $seo_global_og_author = $_POST['seo_global_og_author'];
        } 

        if (
            (isset($_POST['seo_global_fb_id'])) &&
            ($_POST['seo_global_fb_id'] != '')
        )
        {
            $seo_global_fb_id = $_POST['seo_global_fb_id'];
        } 

        if (
            (isset($_POST['seo_global_twitter_card'])) &&
            ($_POST['seo_global_twitter_card'] != '')
        )
        {
            $seo_global_twitter_card = $_POST['seo_global_twitter_card'];
        } 

        if (
            (isset($_POST['seo_global_twitter_site'])) &&
            ($_POST['seo_global_twitter_site'] != '')
        )
        {
            $seo_global_twitter_site = $_POST['seo_global_twitter_site'];
        }
        
        if ($seo_global_id != '')
        {
            $newSeoGlobal = $this->seo_global::find($seo_global_id);
            $newSeoGlobal->geo_placename         = $seo_global_geo_placename;
            $newSeoGlobal->geo_region            = $seo_global_geo_region;
            $newSeoGlobal->geo_position          = $seo_global_geo_position;
            $newSeoGlobal->reflang_alternate1    = $seo_global_reflang_alternate1;
            $newSeoGlobal->reflang_alternate2    = $seo_global_reflang_alternate2;
            $newSeoGlobal->og_locale             = $seo_global_og_locale;
            $newSeoGlobal->og_site               = $seo_global_og_site;
            $newSeoGlobal->og_article_publisher  = $seo_global_og_article_publisher;
            $newSeoGlobal->og_author             = $seo_global_og_author;
            $newSeoGlobal->fb_id                 = $seo_global_fb_id;
            $newSeoGlobal->twitter_card          = $seo_global_twitter_card;
            $newSeoGlobal->twitter_site          = $seo_global_twitter_site;
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
        else
        {
            return redirect()->back()->with('danger', 'The ID of that global record could not be verified');
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



    public function getSeoByName($pageName)
    {
        ////$seo = new Seo();
        /*$whereClause = [
            'seo_page_name' => "$pageName"
        ];

        return $this->seo->selectWhere([],$whereClause);*/
    }



    public function addPage()
    {
        return view('tyfoon-seo::addPage');
    }



    public function savePageSeo(Request $request)
    { 
        //The page name is the only field we make required.
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



    public function viewPageSeo($pageId) /////pageDetail
    {
        $pageData = $this->seo::find($pageId);
        /////echo '<pre>'; die(print_r($globalSeoData));
        return view('tyfoon-seo::pageDetail', ['data' => $pageData]);
    }


    public function editPageSeo($pageId)
    {
        $pageSeoData = $this->seo::find($pageId);
        return view('tyfoon-seo::editPage', ['pageData' => $pageSeoData]);
        /*$seo = new Seo();
        $data = $seo->getPageSeo($pageId);
        $view = DGZ_View::getModuleView('seo', 'editPage', $this, 'html');
        $this->setPageTitle('Edit Page Seo');
        $view->show($data);*/
    }



    public function savePageSeoEdit(Request $request) 
    {
        //We make two fields here mandatory; the ID field, because it's an update. 
        //We also make the page name field mandatory. Every other field is optional
        $request->validate([
            'seo_id' => 'required',
            'seo_page_name' => 'required|string',
        ]);

        //--------------------------------------------------------------
        //echo '<pre>'; dd($request); die();
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
        //--------------------------------------------------------------


       /* $error = '';

        $seo_id = '';
        $seo_page_name = '';
        $seo_meta_title_en = '';
        $seo_meta_title_fre = '';
        $seo_meta_title_es = '';
        $seo_meta_desc_en = '';
        $seo_meta_desc_fre = '';
        $seo_meta_desc_es = '';
        $seo_dynamic = '';
        $seo_keywords_en = '';
        $seo_keywords_fre = '';
        $seo_keywords_es = '';
        $seo_canonical_href = '';
        $seo_no_index = '';
        $seo_h1_text_en = '';
        $seo_h1_text_fre = '';
        $seo_h1_text_es = '';
        $seo_h2_text_en = '';
        $seo_h2_text_fre = '';
        $seo_h2_text_es = '';
        $seo_page_content_en = '';
        $seo_page_content_fre = '';
        $seo_page_content_es = '';
        $seo_og_title_en = '';
        $seo_og_title_fre = '';
        $seo_og_title_es = '';
        $seo_og_desc_en = '';
        $seo_og_desc_fre = '';
        $seo_og_desc_es = '';
        $seo_og_image = '';
        $seo_og_image_width = '';
        $seo_og_image_height = '';
        $seo_og_image_secure_url = '';
        $seo_og_type_en = '';
        $seo_og_type_fre = '';
        $seo_og_type_es = '';
        $seo_og_url = '';
        $seo_og_video = '';
        $seo_twitter_title_en = '';
        $seo_twitter_title_fre = '';
        $seo_twitter_title_es = '';
        $seo_twitter_desc_en = '';
        $seo_twitter_desc_fre = '';
        $seo_twitter_desc_es = '';
        $seo_twitter_image = '';
        
        
        if (
            (isset($_POST['seo_id'])) &&
            ($_POST['seo_id'] != '')
        )
        {
            $seo_id = $_POST['seo_id'];
        }
        else
        {
            $error .= "Record ID not found <br />";
        }

        if (
            (isset($_POST['seo_page_name'])) &&
            ($_POST['seo_page_name'] != '')
        )
        {
            $seo_page_name = $_POST['seo_page_name'];
        }
        else
        {
            $error .= "Please you have to provide the name of the page <br />";
        }

        if (
            (isset($_POST['seo_meta_title_en'])) &&
            ($_POST['seo_meta_title_en'] != '')
        )
        {
            $seo_meta_title_en = $_POST['seo_meta_title_en'];
        }

        if (
            (isset($_POST['seo_meta_title_fre'])) &&
            ($_POST['seo_meta_title_fre'] != '')
        )
        {
            $seo_meta_title_fre = $_POST['seo_meta_title_fre'];
        }

        if (
            (isset($_POST['seo_meta_title_es'])) &&
            ($_POST['seo_meta_title_es'] != '')
        )
        {
            $seo_meta_title_es = $_POST['seo_meta_title_es']; 
        }

        if (
            (isset($_POST['seo_meta_desc_en'])) &&
            ($_POST['seo_meta_desc_en'] != '')
        )
        {
            $seo_meta_desc_en = $_POST['seo_meta_desc_en'];
        } 

        if (
            (isset($_POST['seo_meta_desc_fre'])) &&
            ($_POST['seo_meta_desc_fre'] != '')
        )
        {
            $seo_meta_desc_fre = $_POST['seo_meta_desc_fre'];
        }

        if (
            (isset($_POST['seo_meta_desc_es'])) &&
            ($_POST['seo_meta_desc_es'] != '')
        )
        {
            $seo_meta_desc_es = $_POST['seo_meta_desc_es']; 
        }  

        if (
            (isset($_POST['seo_dynamic'])) &&
            ($_POST['seo_dynamic'] != '')
        )
        {
            $seo_dynamic = $_POST['seo_dynamic'];
        } 

        if (
            (isset($_POST['seo_keywords_en'])) &&
            ($_POST['seo_keywords_en'] != '')
        )
        {
            $seo_keywords_en = $_POST['seo_keywords_en'];
        } 

        if (
            (isset($_POST['seo_keywords_fre'])) &&
            ($_POST['seo_keywords_fre'] != '')
        )
        {
            $seo_keywords_fre = $_POST['seo_keywords_fre'];
        } 

        if (
            (isset($_POST['seo_keywords_es'])) &&
            ($_POST['seo_keywords_es'] != '')
        )
        {
            $seo_keywords_es = $_POST['seo_keywords_es'];
        } 

        if (
            (isset($_POST['seo_canonical_href'])) &&
            ($_POST['seo_canonical_href'] != '')
        )
        {
            $seo_canonical_href = $_POST['seo_canonical_href'];
        } 

        if (
            (isset($_POST['seo_no_index'])) &&
            ($_POST['seo_no_index'] != '')
        )
        {
            $seo_no_index = $_POST['seo_no_index'];
        } 

        if (
            (isset($_POST['seo_h1_text_en'])) &&
            ($_POST['seo_h1_text_en'] != '')
        )
        {
            $seo_h1_text_en = $_POST['seo_h1_text_en']; 
        }

        if (
            (isset($_POST['seo_h1_text_fre'])) &&
            ($_POST['seo_h1_text_fre'] != '')
        )
        {
            $seo_h1_text_fre = $_POST['seo_h1_text_fre'];  
        }

        if (
            (isset($_POST['seo_h1_text_es'])) &&
            ($_POST['seo_h1_text_es'] != '')
        )
        {
            $seo_h1_text_es = $_POST['seo_h1_text_es'];
        }  

        if (
            (isset($_POST['seo_h2_text_en'])) &&
            ($_POST['seo_h2_text_en'] != '')
        )
        {
            $seo_h2_text_en = $_POST['seo_h2_text_en'];  
        }

        if (
            (isset($_POST['seo_h2_text_fre'])) &&
            ($_POST['seo_h2_text_fre'] != '')
        )
        {
            $seo_h2_text_fre = $_POST['seo_h2_text_fre'];  
        }

        if (
            (isset($_POST['seo_h2_text_es'])) &&
            ($_POST['seo_h2_text_es'] != '')
        )
        {
            $seo_h2_text_es = $_POST['seo_h2_text_es'];
        } 

        if (
            (isset($_POST['seo_page_content_en'])) &&
            ($_POST['seo_page_content_en'] != '')
        )
        {
            $seo_page_content_en = $_POST['seo_page_content_en'];  
        }

        if (
            (isset($_POST['seo_page_content_fre'])) &&
            ($_POST['seo_page_content_fre'] != '')
        )
        {
            $seo_page_content_fre = $_POST['seo_page_content_fre']; 
        }

        if (
            (isset($_POST['seo_page_content_es'])) &&
            ($_POST['seo_page_content_es'] != '')
        )
        {
            $seo_page_content_es = $_POST['seo_page_content_es'];
        } 

        if (
            (isset($_POST['seo_og_title_en'])) &&
            ($_POST['seo_og_title_en'] != '')
        )
        {
            $seo_og_title_en = $_POST['seo_og_title_en']; 
        }

        if (
            (isset($_POST['seo_og_title_fre'])) &&
            ($_POST['seo_og_title_fre'] != '')
        )
        {
            $seo_og_title_fre = $_POST['seo_og_title_fre'];  
        }

        if (
            (isset($_POST['seo_og_title_es'])) &&
            ($_POST['seo_og_title_es'] != '')
        )
        {
            $seo_og_title_es = $_POST['seo_og_title_es'];  
        } 

        if (
            (isset($_POST['seo_og_desc_en'])) &&
            ($_POST['seo_og_desc_en'] != '')
        )
        {
            $seo_og_desc_en = $_POST['seo_og_desc_en']; 
        }

        if (
            (isset($_POST['seo_og_desc_fre'])) &&
            ($_POST['seo_og_desc_fre'] != '')
        )
        {
            $seo_og_desc_fre = $_POST['seo_og_desc_fre']; 
        }

        if (
            (isset($_POST['seo_og_desc_es'])) &&
            ($_POST['seo_og_desc_es'] != '')
        )
        {
            $seo_og_desc_es = $_POST['seo_og_desc_es'];  
        } 

        if (
            (isset($_POST['seo_og_image'])) &&
            ($_POST['seo_og_image'] != '')
        )
        {
            $seo_og_image = $_POST['seo_og_image'];
        }

        if (
            (isset($_POST['seo_og_image_width'])) &&
            ($_POST['seo_og_image_width'] != '')
        )
        {
            $seo_og_image_width = $_POST['seo_og_image_width'];
        }

        if (
            (isset($_POST['seo_og_image_height'])) &&
            ($_POST['seo_og_image_height'] != '')
        )
        {
            $seo_og_image_height = $_POST['seo_og_image_height'];
        } 

        if (
            (isset($_POST['seo_og_image_secure_url'])) &&
            ($_POST['seo_og_image_secure_url'] != '')
        )
        {
            $seo_og_image_secure_url = $_POST['seo_og_image_secure_url'];
        }  

        if (
            (isset($_POST['seo_og_type_en'])) &&
            ($_POST['seo_og_type_en'] != '')
        )
        {
            $seo_og_type_en = $_POST['seo_og_type_en']; 
        }

        if (
            (isset($_POST['seo_og_type_fre'])) &&
            ($_POST['seo_og_type_fre'] != '')
        )
        {
            $seo_og_type_fre = $_POST['seo_og_type_fre']; 
        }

        if (
            (isset($_POST['seo_og_type_es'])) &&
            ($_POST['seo_og_type_es'] != '')
        )
        {
            $seo_og_type_es = $_POST['seo_og_type_es'];
        } 

        if (
            (isset($_POST['seo_og_url'])) &&
            ($_POST['seo_og_url'] != '')
        )
        {
            $seo_og_url = $_POST['seo_og_url'];
        }

        if (
            (isset($_POST['seo_og_video'])) &&
            ($_POST['seo_og_video'] != '')
        )
        {
            $seo_og_video = $_POST['seo_og_video'];
        }

        if (
            (isset($_POST['seo_twitter_title_en'])) &&
            ($_POST['seo_twitter_title_en'] != '')
        )
        {
            $seo_twitter_title_en = $_POST['seo_twitter_title_en'];  
        }

        if (
            (isset($_POST['seo_twitter_title_fre'])) &&
            ($_POST['seo_twitter_title_fre'] != '')
        )
        {
            $seo_twitter_title_fre = $_POST['seo_twitter_title_fre'];  
        }

        if (
            (isset($_POST['seo_twitter_title_es'])) &&
            ($_POST['seo_twitter_title_es'] != '')
        )
        {
            $seo_twitter_title_es = $_POST['seo_twitter_title_es'];
        }  

        if (
            (isset($_POST['seo_twitter_desc_en'])) &&
            ($_POST['seo_twitter_desc_en'] != '')
        )
        {
            $seo_twitter_desc_en = $_POST['seo_twitter_desc_en'];
        }

        if (
            (isset($_POST['seo_twitter_desc_fre'])) &&
            ($_POST['seo_twitter_desc_fre'] != '')
        )
        {
            $seo_twitter_desc_fre = $_POST['seo_twitter_desc_fre'];
        }

        if (
            (isset($_POST['seo_twitter_desc_es'])) &&
            ($_POST['seo_twitter_desc_es'] != '')
        )
        {
            $seo_twitter_desc_es = $_POST['seo_twitter_desc_es'];
        }

        if (
            (isset($_POST['seo_twitter_image'])) &&
            ($_POST['seo_twitter_image'] != '')
        )
        {
            $seo_twitter_image = $_POST['seo_twitter_image'];
        }


        if ($error == '')
        {
            $this->seo->seo_id                      = $seo_id;
            $this->seo->seo_page_name               = $seo_page_name;
            $this->seo->seo_meta_title_en           = $seo_meta_title_en;
            $this->seo->seo_meta_title_fre          = $seo_meta_title_fre;
            $this->seo->seo_meta_title_es           = $seo_meta_title_es;
            $this->seo->seo_meta_desc_en            = $seo_meta_desc_en;
            $this->seo->seo_meta_desc_fre           = $seo_meta_desc_fre;
            $this->seo->seo_meta_desc_es            = $seo_meta_desc_es;
            $this->seo->seo_dynamic                 = $seo_dynamic;
            $this->seo->seo_keywords_en             = $seo_keywords_en;
            $this->seo->seo_keywords_fre            = $seo_keywords_fre;
            $this->seo->seo_keywords_es             = $seo_keywords_es;
            $this->seo->seo_canonical_href          = $seo_canonical_href;
            $this->seo->seo_no_index                = $seo_no_index;
            $this->seo->seo_h1_text_en              = $seo_h1_text_en;
            $this->seo->seo_h1_text_fre             = $seo_h1_text_fre;
            $this->seo->seo_h1_text_es              = $seo_h1_text_es;
            $this->seo->seo_h2_text_en              = $seo_h2_text_en;
            $this->seo->seo_h2_text_fre             = $seo_h2_text_fre;
            $this->seo->seo_h2_text_es              = $seo_h2_text_es;
            $this->seo->seo_page_content_en         = $seo_page_content_en;
            $this->seo->seo_page_content_fre        = $seo_page_content_fre;
            $this->seo->seo_page_content_es         = $seo_page_content_es;
            $this->seo->seo_og_title_en             = $seo_og_title_en;
            $this->seo->seo_og_title_fre            = $seo_og_title_fre;
            $this->seo->seo_og_title_es             = $seo_og_title_es;
            $this->seo->seo_og_desc_en              = $seo_og_desc_en;
            $this->seo->seo_og_desc_fre             = $seo_og_desc_fre;
            $this->seo->seo_og_desc_es              = $seo_og_desc_es;
            $this->seo->seo_og_image                = $seo_og_image;
            $this->seo->seo_og_image_width          = $seo_og_image_width;
            $this->seo->seo_og_image_height         = $seo_og_image_height;
            $this->seo->seo_og_image_secure_url     = $seo_og_image_secure_url;
            $this->seo->seo_og_type_en              = $seo_og_type_en;
            $this->seo->seo_og_type_fre             = $seo_og_type_fre;
            $this->seo->seo_og_type_es              = $seo_og_type_es;
            $this->seo->seo_og_url                  = $seo_og_url;
            $this->seo->seo_og_video                = $seo_og_video;
            $this->seo->seo_twitter_title_en        = $seo_twitter_title_en;
            $this->seo->seo_twitter_title_fre       = $seo_twitter_title_fre;
            $this->seo->seo_twitter_title_es        = $seo_twitter_title_es;
            $this->seo->seo_twitter_desc_en         = $seo_twitter_desc_en;
            $this->seo->seo_twitter_desc_fre        = $seo_twitter_desc_fre;
            $this->seo->seo_twitter_desc_es         = $seo_twitter_desc_es;
            $this->seo->seo_twitter_image           = $seo_twitter_image;

            $updated = $this->seo->update();

            if ($updated)
            {
                $this->addSuccess('The page SEO data was updated', 'Success!');
                $this->redirect('seo');
            }
            else
            {
                $this->addErrors('Something went wrong', 'Error!');
                $this->redirect('seo');
            }
        }
        else
        {
            $this->addErrors($error, 'Error!');

            if ((isset($seo_id)) && ($seo_id != ''))
            {
                $this->redirect('seo', 'editPageSeo', ['pageId' => $seo_id]);
            }
            else
            {
                $this->redirect('seo');
            }
        } */
    }


    /**
     * This method receives an AJAX call to verify & relay back to the calling
     * view code if a given page name (which should be unique) is already
     * in use or not
     */
    public function checkPageName()
    {
        /*$langClass = new DGZ_Translator();
        $lang = $this->getLang();

        if (isset($_POST['pageName']))
        {
            $pageName = $_POST['pageName'];
        }

        $query = "SELECT * FROM seo WHERE seo_page_name = '$pageName'";

        $seo = $this->seo->query($query);

        if ($seo)
        {
            die("<b style='color:red'>&nbsp;&larr;
            ".$langClass->translate($lang, 'seo.php', 'page-name-exists')."</b>");
        }
        else
        {
            //We have to return something, but because in this case we want to take no action 
            //on the form if the pageName is unique, we return a null.
            die(null);
        }*/

    }


    public function deletePage() 
    {
       /* if (
            (isset($_POST['pageId'])) &&
            ($_POST['pageId'] != '')
        )
        {
            $pageId = $_POST['pageId'];
            $where = ['seo_id' => $pageId];
            $deleted = $this->seo->deleteWhere($where);

            if ($deleted)
            {
                $this->addSuccess('The page SEO data was deleted', 'Success!');
                $this->redirect('seo');
            }
            else
            {
                $this->addErrors('Could not delete page SEO data', 'Error!');
                $this->redirect('seo');
            }
        }
        else
        {
            $this->addErrors('Record ID not found', 'Error!');
            $this->redirect('seo');
        }*/
    }
}


  
	
	
	