<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\CSRF;
use App\Core\Validator;
use App\Models\Inquiry;
use App\Models\CaseStudy;
use App\Models\Post;
use App\Models\Service;
use App\Models\Stat;

class HomeController {
    public function index(): void {
        $caseStudies = array_values(array_filter(
            CaseStudy::latest(12),
            static fn(array $caseStudy): bool => !empty($caseStudy['slug'])
        ));
        $caseStudies = array_slice($caseStudies, 0, 6);
        $posts = Post::latest(3);
        $services = Service::all();
        $stats = Stat::all();

        $this->render('pages/home', [
            'title' => 'Case Study Labs - Strategic Design & Brand Elevation',
            'caseStudies' => $caseStudies,
            'case_studies' => $caseStudies,
            'posts' => $posts,
            'services' => $services,
            'stats' => $stats,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function work(): void {
        $caseStudies = array_values(array_filter(
            CaseStudy::all(250),
            static fn(array $caseStudy): bool => !empty($caseStudy['slug'])
        ));

        $this->render('pages/work', [
            'title' => 'Our Work - Case Study Labs',
            'caseStudies' => $caseStudies,
            'meta_description' => 'Explore branding, digital, and strategy case studies from Case Study Labs.',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function services(): void {
        $services = Service::all();

        $this->render('pages/services', [
            'title' => 'Services - Case Study Labs',
            'services' => $services,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function serviceDetail(string $slug = ''): void {
        if (!$slug || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found']);
            return;
        }

        $service = Service::findBySlug($slug);
        
        if (!$service) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found']);
            return;
        }

        $caseStudies = CaseStudy::latest(3);

        $this->render('pages/service-detail', [
            'title' => $service['title'] . ' - Case Study Labs',
            'service' => $service,
            'case_studies' => $caseStudies,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudyDetail(string $slug = ''): void {
        if (!$slug || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found']);
            return;
        }

        $caseStudy = CaseStudy::findBySlug($slug);

        if (!$caseStudy) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found']);
            return;
        }

        $description = trim(strip_tags(html_entity_decode($caseStudy['description'] ?? '', ENT_QUOTES, 'UTF-8')));
        $metaDescription = mb_substr($description, 0, 160);
        $imageUrl = $this->absoluteUrl((string) ($caseStudy['hero_image'] ?? ''));
        $jsonLd = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $caseStudy['title'],
            'description' => $description,
            'creator' => [
                '@type' => 'Organization',
                'name' => 'Case Study Labs',
            ],
            'dateCreated' => $caseStudy['year'],
            'image' => $imageUrl,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->render('pages/case-study-detail', [
            'title' => $caseStudy['title'] . ' - Case Study Labs',
            'caseStudy' => $caseStudy,
            'meta_description' => $metaDescription,
            'og_image' => $imageUrl,
            'json_ld' => $jsonLd ?: '',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function contact(): void {
        $this->render('pages/contact', [
            'title' => 'Get in Touch - Case Study Labs',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function submitInquiry(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }

        header('Content-Type: application/json');

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            echo json_encode(['error' => 'Security token invalid']);
            exit;
        }

        $validator = new Validator();
        $data = [
            'name' => $_POST['name'] ?? '',
            'company' => $_POST['company'] ?? '',
            'email' => $_POST['email'] ?? '',
            'message' => $_POST['message'] ?? '',
            'services' => $_POST['services'] ?? [],
            'budget' => $_POST['budget'] ?? '',
        ];

        if (!$validator->validate($data, [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'message' => 'required|min:10|max:2000',
        ])) {
            http_response_code(422);
            echo json_encode(['errors' => $validator->getErrors()]);
            exit;
        }

        $createData = [
            'name' => htmlspecialchars($data['name']),
            'company' => htmlspecialchars($data['company']),
            'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
            'message' => htmlspecialchars($data['message']),
            'services' => is_array($data['services']) ? implode(',', array_map('htmlspecialchars', $data['services'])) : null,
            'budget' => htmlspecialchars($data['budget']),
        ];

        if (Inquiry::create($createData)) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Thank you for your inquiry. We will be in touch soon!',
            ]);
            exit;
        }

        http_response_code(500);
        echo json_encode(['error' => 'Failed to submit inquiry']);
        exit;
    }

    private function render(string $view, array $data = []): void {
        extract($data);
        $__view = $view;
        require __DIR__ . '/../../views/layouts/app.php';
    }

    private function absoluteUrl(string $path): string {
        if ($path === '' || preg_match('#^https?://#i', $path)) {
            return $path;
        }

        $baseUrl = rtrim((string) Config::get('APP_URL', ''), '/');

        if ($baseUrl === '') {
            return $path;
        }

        return $baseUrl . '/' . ltrim($path, '/');
    }
}
