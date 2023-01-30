<?php

namespace App\Helpers;

use App\Http\Controllers\ArchV0rt3xController;

class EmailLayout {

    public static function getSocial() {
        $ArchV0rt3xController = new ArchV0rt3xController();
        return $ArchV0rt3xController->socials();
    }
}
