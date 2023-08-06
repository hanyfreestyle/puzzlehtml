<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebMainController;
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

    public function DevelopersPage()
    {
        $Developers = Developer::query()
            ->with('translation')
            ->orderBy('projects_count','desc')
            ->paginate(12);
        return view('web.developers_index',compact('Developers'));
    }


    public function DeveloperView($slug)
    {
        $Developer = Developer::query()
            ->where('slug',$slug)
            ->withCount('projectCount')
            ->firstOrFail();

        $Projects= Listing::query()
            ->where('developer_id',$Developer->id)
            ->where('listing_type','Project')
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


}
