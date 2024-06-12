<?php

namespace GustoCoder\TyfoonSeo\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Tyfoon_seo_global
 */
class Tyfoon_seo_global extends Model
{
    use HasFactory;

    //because the corresponding table is not 'tyfoonSeoGlobals' 
    protected $table = 'tyfoon_seo_global';

    public $timestamps = false;

    public $guard = [];

    protected static function newFactory()
    {
        return \GustoCoder\TyfoonSeo\Database\Factories\Tyfoon_seo_globalFactory::new();
    }
}


  
	
	
	