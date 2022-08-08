<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;

class Home extends BaseController
{
    public function index()
    {
        $CI_VERSION = CodeIgniter::CI_VERSION;
        $ENVIRONMENT = ENVIRONMENT;
        return $this->render('welcome_message.twig', [
            'CI_VERSION' => $CI_VERSION,
            'ENVIRONMENT' => $ENVIRONMENT,
        ]);
    }
}
