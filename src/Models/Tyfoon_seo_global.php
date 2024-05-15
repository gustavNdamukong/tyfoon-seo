<?php

namespace GustoCoder\TyfoonSeo\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Tyfoon_Seo_global
 */
class Tyfoon_Seo_global extends Model
{
    use HasFactory;

    //because the corresponding table is not 'tyfoonSeoGlobals' 
    protected $table = 'tyfoon_seo_global';

    public $timestamps = false;

    public $guard = [];


    public function getGlobalSeo($globalId)
    {
        return $this->getById($globalId, true); /////
    }
}


  
	
	
	