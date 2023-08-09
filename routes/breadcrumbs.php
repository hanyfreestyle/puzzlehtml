<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('web/menu.home'), route('menu-home'));
});

Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.blog'), route('menu-blog'));
});

Breadcrumbs::for('blogCatList', function (BreadcrumbTrail $trail, $Category) {
    $trail->parent('blog');
    $trail->push($Category->name, route('blogCatList', $Category->slug));
});

Breadcrumbs::for('post_view', function (BreadcrumbTrail $trail, $Category,$Post) {
    $trail->parent('blog');
    $trail->push($Category->name, route('blogCatList', $Category->slug));
    $trail->push($Post->name, route('blogCatList', $Post->slug));
});

Breadcrumbs::for('developer_list', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.developer'), route('menu-developers'));
});

Breadcrumbs::for('developer_view', function (BreadcrumbTrail $trail,$Developer) {
    $trail->parent('developer_list');
    $trail->push( $Developer->name , route('page-developer-view',$Developer->slug));
});


