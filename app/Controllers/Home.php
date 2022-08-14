<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;

class Home extends BaseController
{
    public function index()
    {
        // Get global variables
        $data = [
            'CI_VERSION' => CodeIgniter::CI_VERSION,
            'ENVIRONMENT' => ENVIRONMENT,
        ];

        // Render 'app/Views/welcome_message.twig'.
        return $this->render('welcome_message.twig', $data);
    }
}
