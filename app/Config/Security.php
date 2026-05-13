<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    public $csrfProtection = false;  // Disable CSRF protection
    public $tokenRandomize = false;
    public $regenerate = false;
    public $redirect = false;
    public $cookieSameSite = 'Lax';
}   