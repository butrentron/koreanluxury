<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FeedController extends Controller
{
    public function generate()
    {
        $posts = \App\Product::latest()->take(10)->get();

        $setting = \App\Setting::first();
        $feed = \App::make('feed');
		$feed->title = $setting->title;
		$feed->description = $setting->description;
		$feed->logo = url($setting->logo);
		$feed->link = url('feed');
		$feed->setDateFormat('datetime'); 
		$feed->pubdate = $posts[0]->created_at;
		$feed->lang = 'en';
		$feed->setShortening(true);
		$feed->setTextLimit(100);
		foreach ($posts as $post)
		{
		    $feed->add($post->name, 'Tên sản phẩm', 
		    			route('site.products', [ $post->id, $post->slug ]), 
		    			$post->created_at, $post->content, $post->content);
		}

		return $feed->render('rss');
    }
}
