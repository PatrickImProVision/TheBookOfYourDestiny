<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
 *
 * @package CodeIgniter
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded globally in every request.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the controller's helpers
        if (!empty($this->helpers)) {
            $this->helpers = array_merge([
                'url',
            ], $this->helpers);
        }
        $this->helpers = array_merge([
            'url',
        ], $this->helpers ?? []);

        helper($this->helpers);

        // The Book Of Your Destiny - Initialize View Data
        $this->data = [];
        $this->data['page_title'] = 'The Book Of Your Destiny';
        $this->data['page_description'] = 'A Micro‑Store MVC FrameWork for E-Book Management';
    }

    protected $data = [];

    /**
     * Helper method to return JSON response
     */
    protected function response_json($data = [], $status = 200)
    {
        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json')
            ->setBody(json_encode($data));
    }
}
