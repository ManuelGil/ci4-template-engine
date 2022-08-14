<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    private $templateEngine;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $loader = new Mustache_Loader_FilesystemLoader(APPPATH . 'Views');

        if (ENVIRONMENT === 'production') {
            $this->templateEngine = new Mustache_Engine(
                [
                    'loader' => $loader,
                ]
            );
        } else {
            $this->templateEngine = new Mustache_Engine(
                [
                    'loader' => $loader,
                ]
            );
        }

        // Create a new filter for base_url.
        $this->templateEngine->addHelper('base_url', function (string $uri) {
            return base_url($uri);
        });

        // Create a new filter for route_to.
        $this->templateEngine->addHelper('route_to', function (string $uri) {
            return route_to($uri);
        });

        // Create a new filter for get_segment.
        $this->templateEngine->addHelper('get_segment', function (int $segment) {
            return service('uri')->setSilent()->getSegment($segment);
        });

        // Create a new filter for session.
        $this->templateEngine->addHelper('session', function (string $key) {
            return session($key);
        });

        // Create a new filter for old.
        $this->templateEngine->addHelper('old', function ($key) {
            return old($key);
        });

        // Create a new filter for set_value.
        $this->templateEngine->addHelper('set_value', function ($field, $default) {
            return set_value($field, $default);
        });

        // Create a new filter for csrf_token.
        $this->templateEngine->addHelper('csrf_token', function () {
            return csrf_token();
        });

        // Create a new filter for csrf_hash.
        $this->templateEngine->addHelper('csrf_hash', function () {
            return csrf_hash();
        });

        // Create a new filter for csrf_field.
        $this->templateEngine->addHelper('csrf_field', function () {
            return csrf_field();
        });
    }

    /**
     * This method render the template.
     *
     * @param string $filename - the filename of template.
     * @param array $params - the data with context of the template.
     * @return void
     */
    public function render(string $filename, array $params = [])
    {
        try {
            // Render the template.
            return $this->templateEngine->render($filename, $params);
        } catch (\Throwable $e) {
            if (ENVIRONMENT === 'production') {
                // Save error in file log
                log_message('error', $e->getTraceAsString());
            } else {
                // Show error in the current page
                header_remove();
                http_response_code(500);
                header('HTTP/1.1 500 Internal Server Error');
                echo '<pre>' . $e->getTraceAsString() . '</pre>';
                echo PHP_EOL;
                echo $e->getMessage();
                exit;
            }
        }
    }
}
