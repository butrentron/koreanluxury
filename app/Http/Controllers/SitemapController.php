<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SitemapController extends Controller
{
    public function generate() {
    	/* add item to the sitemap (url, date, priority, freq) */
	    $sitemap = \App::make("sitemap");
	    $sitemap->add(\URL::to('/'), '2016-04-20 06:41:16', '1.0', 'daily');
	    
	 	//pages
	    $pages = \DB::table('pages')
	                ->select('*')
	                    ->orderBy('created_at','desc')
	                    ->get();
	    $pageResult = array();
	    if(!empty($pages)){
	        foreach ($pages as $key => $value) {
	            $pageResult[$value->id]['id'] = $value->id;
	            $pageResult[$value->id]['uri'] = $value->uri;
	            $pageResult[$value->id]['name'] = $value->name;
	            $pageResult[$value->id]['updated_at'] = $value->updated_at;
	        }
	    }

	    foreach ($pageResult as $key=>$value)
	     {
	        $sitemap->add(\URL::route('site.pages',[ 'uri' => $value['uri']]), $value['updated_at'], '1.0', 'daily');
	    }
	    
	 	//categories
	    $categories = \DB::table('categories')
	                ->select('*')
	                    ->orderBy('created_at','desc')
	                    ->get();
	    $categeoryResult = array();
	    if(!empty($categories)){
	        foreach ($categories as $key => $value) {
	            $categeoryResult[$value->id]['id'] = $value->id;
	            $categeoryResult[$value->id]['slug'] = $value->slug;
	            $categeoryResult[$value->id]['name'] = $value->name;
	            $categeoryResult[$value->id]['updated_at'] = $value->updated_at;
	        }
	    }

	    foreach ($categeoryResult as $key=>$value)
	     {
	        $sitemap->add(\URL::route('site.categories',[ 'id' => $value['id'], 'slug' => $value['slug']]), $value['updated_at'], '1.0', 'daily');
	    }

	 	//brands
	    $brands = \DB::table('brands')
	                ->select('*')
	                    ->orderBy('created_at','desc')
	                    ->get();
	    $brandResult = array();
	    if(!empty($brands)){
	        foreach ($brands as $key => $value) {
	            $brandResult[$value->id]['id'] = $value->id;
	            $brandResult[$value->id]['slug'] = $value->slug;
	            $brandResult[$value->id]['name'] = $value->name;
	            $brandResult[$value->id]['updated_at'] = $value->updated_at;
	        }
	    }

	    foreach ($brandResult as $key=>$value)
	     {
	        $sitemap->add(\URL::route('site.brands',[ 'id' => $value['id'], 'slug' => $value['slug']]), $value['updated_at'], '1.0', 'daily');
	    }

	 	//types
	    $types = \DB::table('types')
	                ->select('*')
	                    ->orderBy('created_at','desc')
	                    ->get();
	    $typeResult = array();
	    if(!empty($types)){
	        foreach ($types as $key => $value) {
	            $typeResult[$value->id]['id'] = $value->id;
	            $typeResult[$value->id]['slug'] = $value->slug;
	            $typeResult[$value->id]['name'] = $value->name;
	            $typeResult[$value->id]['updated_at'] = $value->updated_at;
	        }
	    }

	    foreach ($typeResult as $key=>$value)
	     {
	        $sitemap->add(\URL::route('site.brands',[ 'id' => $value['id'], 'slug' => $value['slug']]), $value['updated_at'], '1.0', 'daily');
	    }

	    //products              
	    $posts = \DB::table('products')
	                ->select('*')
	                    ->orderBy('created_at','desc')
	                    ->get();
	    $postResult = array();
	    if(!empty($posts)){
	        foreach ($posts as $key => $value) {
	            $postResult[$value->id]['id'] = $value->id;
	            $postResult[$value->id]['slug'] = $value->slug;
	            $postResult[$value->id]['name'] = $value->name;
	            $postResult[$value->id]['updated_at'] = $value->updated_at;
	            $postResult[$value->id]['image'][] = $value->image;
	        }
	    }
	    
	     /* add every post to the sitemap */
	     foreach ($postResult as $key=>$value)
	     {
	        $images = array();
	        foreach ($value['image'] as $key2 => $value2) {
	            $images[] = array(
	                'url' => url($value2),
	                'title' => $value['slug'],
	                'caption' => $value['name']
	            );    
	        }
	        $sitemap->add(\URL::route('site.products',[ 'id' => $value['id'], 'slug' => $value['slug']]), $value['updated_at'], '1.0', 'daily', $images);
	    }
	    
	    /* show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf') */
	    return $sitemap->render('xml');
    }
}
