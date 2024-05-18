<?php

namespace GustoCoder\TyfoonSeo\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Tyfoon_seo
 */
class Tyfoon_seo extends Model
{
    use HasFactory;

    //because the corresponding table is not 'tyfoonSeos' 
    protected $table = 'tyfoon_seo';

    public $timestamps = false;

    public $guard = [];
}


  
	
	
	