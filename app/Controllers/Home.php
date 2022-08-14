<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'CI_VERSION' => CodeIgniter::CI_VERSION,
            'ENVIRONMENT' => ENVIRONMENT,
            'YEAR' => date('Y'),
        ];

        // Render 'app\Views\welcome_message.mustache'
        return $this->render('welcome_message.mustache', $data);
    }
}
