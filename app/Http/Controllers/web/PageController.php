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
//            ->withCount('projectCount')
//            ->orderBy('project_count_count','desc')
            ->paginate(12);




        return view('web.developers_index',compact('Developers'));
    }


    public function DeveloperView($slug)
    {
        $Developer = Developer::query()
            ->where('slug',$slug)
            ->withCount('projectCount')
            ->firstOrFail();

//dd();
//

        $Projects= Listing::query()
            ->where('developer_id',$Developer->id)
            ->where('listing_type','Project')
            ->paginate(6, ['*'], 'compound_page')
             ;


        $Units= Listing::query()
            ->where('developer_id',$Developer->id)
            ->where('listing_type','Unit')
            ->paginate(6, ['*'], 'property_page')
             ;




        return view('web.developers_view',compact('Developer','Projects','Units'));
    }


}
