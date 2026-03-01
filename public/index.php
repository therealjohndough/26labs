<?php
/**
 * 26 Labs Application Entry Point
 * 
 * Public root index.php - handles all requests
 */

// Enable error reporting in development
error_reporting(E_ALL);
ini_set('display_errors', 0); // Log errors, don't display

// Start session
session_start();
session_regenerate_id(true);

// Set security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

// Define application root
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', getenv('APP_ENV') ?: 'production');

// Composer autoloader
require_once APP_ROOT . '/vendor/autoload.php';

// Load configuration
use App\Core\Config;
use App\Core\Database;
use App\Core\Router;

Config::load(APP_ROOT . '/.env');

// Initialize database
Database::initialize(
    Config::get('DB_HOST'),
    Config::get('DB_NAME'),
    Config::get('DB_USER'),
    Config::get('DB_PASS'),
    (int)Config::get('DB_PORT', 3306)
);

// Setup routing
$router = new Router();

// Frontend routes
$router->get('/', 'HomeController@index');
$router->post('/inquiry', 'HomeController@submitInquiry');

// Admin routes
$router->get('/admin/login', 'AuthController@showLogin', ['App\Core\GuestMiddleware']);
$router->post('/admin/login', 'AuthController@login', ['App\Core\GuestMiddleware']);
$router->get('/admin/logout', 'AuthController@logout');

$router->get('/admin/dashboard', 'AdminController@dashboard', ['App\Core\AuthMiddleware']);

// Case Studies
$router->get('/admin/case-studies', 'AdminController@caseStudies', ['App\Core\AuthMiddleware']);
$router->get('/admin/case-studies/create', 'AdminController@caseStudiesCreate', ['App\Core\AuthMiddleware']);
$router->post('/admin/case-studies', 'AdminController@caseStudiesStore', ['App\Core\AuthMiddleware']);
$router->get('/admin/case-studies/{id}/edit', 'AdminController@caseStudiesEdit', ['App\Core\AuthMiddleware']);
$router->post('/admin/case-studies/{id}/update', 'AdminController@caseStudiesUpdate', ['App\Core\AuthMiddleware']);
$router->post('/admin/case-studies/{id}/delete', 'AdminController@caseStudiesDelete', ['App\Core\AuthMiddleware']);

// Inquiries
$router->get('/admin/inquiries', 'AdminController@inquiries', ['App\Core\AuthMiddleware']);
$router->get('/admin/inquiries/{id}', 'AdminController@inquiriesView', ['App\Core\AuthMiddleware']);
$router->post('/admin/inquiries/{id}/delete', 'AdminController@inquiriesDelete', ['App\Core\AuthMiddleware']);

// Dispatch request
$router->dispatch();
