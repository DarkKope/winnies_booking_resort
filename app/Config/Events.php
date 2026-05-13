<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;

Events::on('pre_system', function() {
    if (session_status() === PHP_SESSION_NONE) {
        session()->start();
    }
});