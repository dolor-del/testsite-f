<?php

return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
        'url' => 'main/index',
    ],

    'discipline' => [
        'controller' => 'discipline',
        'action' => 'show',
        'url' => 'discipline/show',
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
        'url' => 'account/login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
        'url' => 'account/register',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
        'url' => 'account/logout',
    ],

    'account/edit' => [
        'controller' => 'account',
        'action' => 'edit',
        'url' => 'account/edit',
    ],

    'admin' => [
        'controller' => 'admin',
        'action' => 'index',
        'url' => 'admin/index',
    ],

    'admin/works' => [
        'controller' => 'adminWorks',
        'action' => 'main',
        'url' => 'admin/works/main',
    ],

    'admin/works/edit' => [
        'controller' => 'adminWorks',
        'action' => 'edit',
        'url' => 'admin/works/edit',
    ],

    'admin/works/add/discipline' => [
        'controller' => 'adminWorks',
        'action' => 'addDiscipline',
        'url' => 'admin/works/add/discipline',
    ],

    'admin/works/add/work' => [
        'controller' => 'adminWorks',
        'action' => 'addWork',
        'url' => 'admin/works/add/work',
    ],

    'admin/results' => [
        'controller' => 'adminResults',
        'action' => 'main',
        'url' => 'admin/results/main',
    ],

    'admin/users' => [
        'controller' => 'adminUsers',
        'action' => 'main',
        'url' => 'admin/users/main',
    ],

    'admin/users/add' => [
        'controller' => 'adminUsers',
        'action' => 'add',
        'url' => 'admin/users/add',
    ],

    'admin/users/edit' => [
        'controller' => 'adminUsers',
        'action' => 'edit',
        'url' => 'admin/users/edit',
    ],

];