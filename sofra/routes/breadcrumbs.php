<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Dashboard', route('user.dashboard'));
});

// Account Info
Breadcrumbs::for('user.account-info', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Account Info', route('user.account-info'));
});

// Orders
Breadcrumbs::for('user.orders', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Orders', route('user.orders'));
});

Breadcrumbs::for('about', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('About Us', route('about'));
});

Breadcrumbs::for('show', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Contact Us', route('show'));
});

Breadcrumbs::for('all', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('All Kitchens', route('all'));
});




