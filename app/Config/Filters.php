<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot'      => \CodeIgniter\Filters\Honeypot::class,
        'auth'          => \App\Filters\Auth::class,
        'admin'         => \App\Filters\AdminAuth::class,  // Make sure this line exists
    ];

    public $globals = [
        'before' => [
            // 'csrf' => ['except' => ['ajax/*']],
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public $methods = [];
    public $filters = [];
}