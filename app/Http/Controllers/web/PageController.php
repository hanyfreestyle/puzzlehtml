<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebMainController;
use App\Models\admin\Category;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Post;
use Illuminate\Http\Request;

class PageController extends WebMainController
{
    public function index()
    {
//        $post = Post::where("id",250)->firstOrFail();
//
//        parent::printSeoMeta($post);
       return view('web.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DevelopersPage
    public function DevelopersPage()
    {
        $Developers = Developer::query()
            ->with('translation')
            ->orderBy('projects_count','desc')
            ->paginate(12);
        return view('web.developers_index',compact('Developers'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeveloperView
    public function DeveloperView($slug)
    {
        $Developer = Developer::query()
            ->where('slug',$slug)
            ->withCount('projectCount')
            ->firstOrFail();

        $Projects= Listing::query()
            ->where('developer_id',$Developer->id)
            ->where('listing_type','Project')
            ->with('locationName')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'compound_page')
        ;


        $Units= Listing::query()
            ->where('developer_id',$Developer->id)
            ->where('listing_type','Unit')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'property_page')
        ;

        $Posts = Post::query()
            ->where('developer_id',$Developer->id)
            ->orderBy('id','asc')
            ->limit(10)
            ->get()
        ;

     return view('web.developers_view',compact('Developer','Projects','Units','Posts'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogPageList
    public function BlogPageList()
    {
        $Posts = Post::query()
            ->where('is_published' ,true)
            ->with('translation')
            ->with('getCatName')
            ->orderBy('id','desc')
            ->paginate(12);




        $Categories = Category::query()
            ->where('is_active',true)
            ->withCount('post_count')
            ->with('translation')
            ->get()
        ;

        return view('web.blog_index',compact('Posts','Categories'));

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function BlogCatList($catSlug)
    {
        $Category = Category::query()
            ->where('is_active',true)
            ->where('slug',$catSlug)
          //  ->withCount('post_count')
           // ->with('translation')
            ->firstOrFail();
        ;
        $Posts = Post::query()
            ->where('is_published',true)
            ->where('category_id',$Category->id)

            ->with('translation')
            ->with('getCatName')
            ->orderBy('id','desc')
            ->paginate(12);
        return view('web.blog_cat_index',compact('Posts','Category'));

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function BlogView($catSlug,$postSlug)
    {

        $Post = Post::query()
            ->where('slug',$postSlug)
            ->with('getLoationName')
            ->firstOrFail()
        ;

        if($Post->listing_id == null){
            $project_tag = null ;
        }else{
            $project_tag = Listing::query()
                ->where('id',$Post->listing_id)
                ->with('developerName')
                ->first();
            ;
        }


        if($Post->location_id == null){
            $relatedProjects = null;
        }else{
            $relatedProjects = Listing::query()
                ->where('listing_type','Project')
                ->where('location_id',$Post->location_id)
                ->with('locationName')
                ->limit(10)
                ->get();
            ;

            if(count($relatedProjects) == 0){
                $relatedProjects = null;
            }


        }




        return view('web.blog_view',compact('Post','project_tag','relatedProjects'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text



}
