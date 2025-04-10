# TYFOON-SEO A Laravel SEO package

Laravel seo package. Optimize your web pages for seo. It will walk you through the creation of all necessary seo tags, often explaining to you the purpose of each tag, its format, syntax, etc. The seo elements will then be generated for you at every view request. Just add that to the layout of the view.


## How to install it

```bash 
    composer require gustocoder/tyfoon-seo
```

After installation
 The migration files will be published for you in:

      'database/migrations/'

 If not, you can publish them by running this command in your CLI  :

```bash 
    php artisan vendor:publish --tag=tyfoon-seo-migrations
```

 Next, run the migrations to create the seo DB tables   :

```bash 
    php artisan migrate
```

OR

 You may choose to run only the migrations for your seo tables-leaving your other 
 application DB tables alone. Run these two migrations one after the other.
 Just verify in your 'database/migrations' directory that the filenames below are correct   :

```bash 
    php artisan migrate:refresh --path=/database/migrations/2024_05_14_091500_create_tyfoon_seo_global_table.php

    php artisan migrate:refresh --path=/database/migrations/2024_05_14_091510_create_tyfoon_seo_table.php
```
 
 If you have issues, make sure that the TyfoonSeoServiceProvider class is registered in your
 /bootstrap/providers.php. 


 ### Publishing the Config File

 To publish the package configuration file, run:

```bash
php artisan vendor:publish --provider="Gustocoder\TyfoonSeo\TyfoonSeoServiceProvider" --tag=config
```

# Using the package
 ## The landing page (home) route of the package is the following 

 The visit the route '/seo' in your application, for example `yourAppName/seo`

![Example Tyfoon-seo landing page](https://github.com/gustavNdamukong/tyfoon-seo/blob/main/public/main/images/seo-home.png?raw=true)

 Here you can see options to create global SEO data that will be applied to all pages of your website. These include things like the language the website is in, the geo-location, the site publisher, facebook/twitter ID etc

 
## When you click the button to create global SEO data, here is what the form looks like

![Global SEO form](https://github.com/gustavNdamukong/tyfoon-seo/blob/main/public/main/images/seo-global.png?raw=true)


## When you click the button to create SEO data for a page, here is what the form looks like

You will have to create and save entries for each individual web page of your website. This can be a tedious and meticulous 
process, but that is what Tyfoon SEO is here to help you with. Seo optimization is a tedious process, especially because the data 
on every page has to be unique. 

Tyfoon SEO makes this process for you by providing you the known fields, so that you do not have to know SEO fields that web pages
need. It means you can use this package to optimize your webpage to rank to number one on search engines without being an SEO expert.
However, though Tyfoon SEO cannot help you with the other aspects of SEO that have to do with marketing, and link building, it covers 
you on the first and very important aspect of on-page SEO also know as technical SEO.

* What is more; on the form to create SEO data, above every form field, is text in a label to inform you about that piece of data and 
  why it is necessary. It aims to provide you with information like:

  * The SEO data name
  * What it means 
  * The maximum character length, if applicaple-it will even restrict the number of characters you can enter to that section.

This is all really good, and the intention is that you will learn a lot about SEO from this system. We wanted to share with you 
lessons we learned through lots of research and experience gathered from optimizing web pages for search engines.

In the end, Tyfoon SEO provides you with functions you can call in your view layouts to have all the SEO data of that view 
generated and inserted in the view for you. I will show you the functions below. Once you have taken the pain to complete the form, 
and to create the SEO data for all your view files; you will be almost done. All you will have left to do will be to copy and paste the 
code snippet provided below in your view layouts. 




![SEO form for a specific page](https://github.com/gustavNdamukong/tyfoon-seo/blob/main/public/main/images/seo-page-1.png?raw=true)

![SEO form for a specific page](https://github.com/gustavNdamukong/tyfoon-seo/blob/main/public/main/images/seo-page-2.png?raw=true)

![SEO form for a specific page](https://github.com/gustavNdamukong/tyfoon-seo/blob/main/public/main/images/seo-page-3.png?raw=true)

Make sure the page_name field value exactly matches the name of the target view file.

As you may have noticed from the form entry fields; Tyfoon seo supports three languages; English, French and Spanish. Is your 
website not multi-lingual, not a problem, just ignore the non-relevant language fields. They are not required.


## Here is the code snippet to paste into your layout/view files so the SEO data can be injected

### Layout file 

    Note that this whould be the layout file extended by the view files you want to inject SEO 
    data into.

```php 
    @if(isset($globalSeoMetadata))
		{!! $globalSeoMetadata !!}
	@endif 

    @if(isset($pageSeoMetadata))
        {!! $pageSeoMetadata !!}
    @else
        <title>@yield('title', config('app.name'))</title>
    @endif
```

### Individual view file 

    Tyfoon SEO provides some pieces of data that you need to inject into specific views. 
    These are not shared by other views. The three pieces of data are the following, 
    which are deemed to be the most important for on-page SEO purposes: 

    * H1 text

    * H2 text

    * Page content

    Simple place each of them anywhere in the view file you would like the data to be 
    injected. That is magic of it-the flexibility of it.

```php 
    <h1>{!! $bodySeoData['h1_text'] !!}</h1>
``` 

OR

```php 
    <h2>{!! $bodySeoData['h2_text'] !!}</h2>
``` 

OR  

```php 
    <p>{!! $bodySeoData['page_content'] !!}</p>
``` 

OR you can have them all in one place if you want

```php 
    @if(isset($bodySeoData))
        <h1>{!! $bodySeoData['h1_text'] !!}</h1>

        <h2>{!! $bodySeoData['h2_text'] !!}</h2>

        <p>{!! $bodySeoData['page_content'] !!}</p>
    @endif 
``` 
                            

Speaking of content meant for specific pages; besides those offered by Tyfoon seo above, you will want to display unique titles for each page. Tyfoon seo covers that as it has a page title field in the page form, which is part of the snippet you add to your layout file. However, if you did not want to create SEO data for a specific page but need it to have a unique title, you need to manually add that to the view file like so-right after extending the layout file:                   

```php 
    @extends('layouts.main.app')

    @section('title', 'myWebApp - products')
    ...
``` 


### Requirements and dependencies

    * It used PHP version 7.0 ^

    * Redis caching (optional). Because SEO data is fecched for each view at page load, it made 
    sense to add caching. You will therefore be running Redis on your server, as well as have maybe the Predis extension installed in your Laravel application via Composer. Of course if you do not want caching, you can disable that in the config file (/cofig/tyfoon-seo.php) by setting the value of the 'cacheabe' key to false like so:

```php
    return [
        'cacheable' => false,
        ...
    ];  
```
