<?php
namespace App\Http\Controllers;



use App\Models\admin\Post;

class HomeController extends WebMainController
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $post = Post::where("id",250)->firstOrFail();

        parent::printSeoMeta($post);


//        $lang = thisCurrentLocale();
//        SEOMeta::setTitle($post->translate($lang)->name ?? "");

//        SEOMeta::setCanonical(Url::full());
//
//        SEOMeta::addMeta('article:published_time', $post->published_at, 'property');
//        SEOMeta::addMeta('article:section', $post->category_id, 'property');
//        SEOMeta::addKeyword(['key1', 'key2', 'key3']);
//
//        OpenGraph::setDescription('This is my page description');
//        OpenGraph::setTitle('Home');
//        OpenGraph::setUrl('http://current.url.com');
//        OpenGraph::addProperty('type', 'articles');
//
//
//
//
//
//        TwitterCard::setTitle('Homepage');
//        TwitterCard::setSite('@LuizVinicius73');
//
//        JsonLd::setTitle('Homepage');
//        JsonLd::setDescription('This is my page description');
//        JsonLd::addImage('https://codecasts.com.br/img/logo.jpg');
//



        // OR

//        SEOTools::setTitle('Home');
//        SEOTools::setDescription('This is my page description');
//        SEOTools::opengraph()->setUrl('http://current.url.com');
//        SEOTools::setCanonical('https://codecasts.com.br/lesson');
//        SEOTools::opengraph()->addProperty('type', 'articles');
//        SEOTools::twitter()->setSite('@LuizVinicius73');
//        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
//
//
        return view('web.index');
       // return view('seo');
    }



}
