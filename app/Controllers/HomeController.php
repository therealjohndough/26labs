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
            'meta_description' => 'Case Study Labs helps brands grow through strategy, design, content, and high-performing digital experiences.',
            'canonical_url' => $this->buildCanonicalUrl('/'),
            'caseStudies' => $caseStudies,
            'case_studies' => $caseStudies,
            'posts' => $posts,
            'services' => $services,
            'stats' => $stats,
            'json_ld' => [
                $this->organizationSchema(),
                $this->websiteSchema(),
            ],
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function work(): void {
        $activeTag = trim((string) ($_GET['tag'] ?? ''));
        $caseStudies = array_values(array_filter(
            CaseStudy::all(250),
            static fn(array $caseStudy): bool => !empty($caseStudy['slug'])
        ));
        $availableTags = $this->collectCaseStudyTags($caseStudies);

        if ($activeTag !== '') {
            $caseStudies = array_values(array_filter(
                $caseStudies,
                fn(array $caseStudy): bool => $this->caseStudyHasTag($caseStudy, $activeTag)
            ));
        }

        $title = $activeTag !== ''
            ? 'Our Work - ' . $activeTag . ' - Case Study Labs'
            : 'Our Work - Case Study Labs';
        $metaDescription = $activeTag !== ''
            ? 'Explore ' . $activeTag . ' case studies from Case Study Labs.'
            : 'Explore branding, digital, and strategy case studies from Case Study Labs.';

        $this->render('pages/work', [
            'title' => $title,
            'caseStudies' => $caseStudies,
            'availableTags' => $availableTags,
            'activeTag' => $activeTag,
            'meta_description' => $metaDescription,
            'canonical_url' => $this->buildCanonicalUrl('/work'),
            'meta_robots' => $activeTag !== '' ? 'noindex,follow' : 'index,follow',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function services(): void {
        $services = Service::all();

        $this->render('pages/services', [
            'title' => 'Services - Case Study Labs',
            'meta_description' => 'Explore strategy, branding, web design, media buying, content, and lifecycle marketing services from Case Study Labs.',
            'canonical_url' => $this->buildCanonicalUrl('/services'),
            'services' => $services,
            'json_ld' => [
                $this->organizationSchema(),
                $this->serviceCatalogSchema($services),
            ],
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function serviceDetail(string $slug = ''): void {
        if (!$slug || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found', 'meta_robots' => 'noindex,follow']);
            return;
        }

        $service = Service::findBySlug($slug);
        
        if (!$service) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found', 'meta_robots' => 'noindex,follow']);
            return;
        }

        $caseStudies = CaseStudy::latest(3);
        $rawDescription = (string) (($service['short_description'] ?? '') !== '' ? $service['short_description'] : ($service['description'] ?? ''));
        $description = trim(strip_tags(html_entity_decode($rawDescription, ENT_QUOTES, 'UTF-8')));
        $metaDescription = mb_substr($description, 0, 160);
        $canonicalUrl = $this->buildCanonicalUrl('/services/' . $slug);

        $this->render('pages/service-detail', [
            'title' => $service['title'] . ' - Case Study Labs',
            'meta_description' => $metaDescription,
            'canonical_url' => $canonicalUrl,
            'service' => $service,
            'case_studies' => $caseStudies,
            'json_ld' => [
                $this->organizationSchema(),
                $this->serviceSchema($service, $canonicalUrl),
                $this->breadcrumbSchema([
                    ['name' => 'Home', 'url' => $this->buildCanonicalUrl('/')],
                    ['name' => 'Services', 'url' => $this->buildCanonicalUrl('/services')],
                    ['name' => (string) $service['title'], 'url' => $canonicalUrl],
                ]),
            ],
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudyDetail(string $slug = ''): void {
        if (!$slug || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found', 'meta_robots' => 'noindex,follow']);
            return;
        }

        $caseStudy = CaseStudy::findBySlug($slug);

        if (!$caseStudy) {
            http_response_code(404);
            $this->render('pages/404', ['title' => 'Not Found', 'meta_robots' => 'noindex,follow']);
            return;
        }

        $description = trim(strip_tags(html_entity_decode($caseStudy['description'] ?? '', ENT_QUOTES, 'UTF-8')));
        $metaDescription = mb_substr($description, 0, 160);
        $heroPath = (string) ($caseStudy['hero_image'] ?? '');
        $socialImagePath = $heroPath !== '' ? $heroPath : $this->fallbackCoverPath($slug);
        $imageUrl = $this->absoluteUrl($socialImagePath);
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
        $canonicalUrl = $this->buildCanonicalUrl('/work/' . $slug);

        $this->render('pages/case-study-detail', [
            'title' => $caseStudy['title'] . ' - Case Study Labs',
            'caseStudy' => $caseStudy,
            'meta_description' => $metaDescription,
            'canonical_url' => $canonicalUrl,
            'og_type' => 'article',
            'og_image' => $imageUrl,
            'json_ld' => array_values(array_filter([
                $this->organizationSchema(),
                $jsonLd ?: '',
                $this->breadcrumbSchema([
                    ['name' => 'Home', 'url' => $this->buildCanonicalUrl('/')],
                    ['name' => 'Work', 'url' => $this->buildCanonicalUrl('/work')],
                    ['name' => (string) $caseStudy['title'], 'url' => $canonicalUrl],
                ]),
            ])),
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function contact(): void {
        $this->render('pages/contact', [
            'title' => 'Get in Touch - Case Study Labs',
            'meta_description' => 'Contact Case Study Labs to discuss brand strategy, design, web, and growth campaigns.',
            'canonical_url' => $this->buildCanonicalUrl('/contact'),
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
        if (!isset($data['canonical_url'])) {
            $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
            $data['canonical_url'] = $this->buildCanonicalUrl($requestPath);
        }

        if (!isset($data['meta_robots'])) {
            $isProduction = strtolower((string) Config::get('APP_ENV', 'production')) === 'production';
            $data['meta_robots'] = $isProduction ? 'index,follow' : 'noindex,nofollow';
        }

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

    private function fallbackCoverPath(string $slug): string {
        $relativePath = '/uploads/case-studies/covers/' . $slug . '.svg';
        $absolutePath = APP_ROOT . '/public' . $relativePath;

        return file_exists($absolutePath) ? $relativePath : '';
    }

    private function collectCaseStudyTags(array $caseStudies): array {
        $tags = [];

        foreach ($caseStudies as $caseStudy) {
            foreach ($this->parseCsvList((string) ($caseStudy['tags'] ?? '')) as $tag) {
                $key = strtolower($tag);

                if (!isset($tags[$key])) {
                    $tags[$key] = $tag;
                }
            }
        }

        natcasesort($tags);

        return array_values($tags);
    }

    private function caseStudyHasTag(array $caseStudy, string $tag): bool {
        $needle = strtolower($tag);

        foreach ($this->parseCsvList((string) ($caseStudy['tags'] ?? '')) as $caseStudyTag) {
            if (strtolower($caseStudyTag) === $needle) {
                return true;
            }
        }

        return false;
    }

    private function parseCsvList(string $value): array {
        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    private function buildCanonicalUrl(string $path): string {
        $baseUrl = rtrim((string) Config::get('APP_URL', ''), '/');
        $normalizedPath = '/' . ltrim($path, '/');

        if ($normalizedPath === '/index.php') {
            $normalizedPath = '/';
        } elseif (str_starts_with($normalizedPath, '/index.php/')) {
            $normalizedPath = substr($normalizedPath, strlen('/index.php'));
        }

        if ($normalizedPath !== '/') {
            $normalizedPath = rtrim($normalizedPath, '/');
        }

        if ($baseUrl === '') {
            return $normalizedPath;
        }

        return $baseUrl . $normalizedPath;
    }

    private function organizationSchema(): string {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Case Study Labs',
            'url' => $this->buildCanonicalUrl('/'),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '';
    }

    private function websiteSchema(): string {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Case Study Labs',
            'url' => $this->buildCanonicalUrl('/'),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '';
    }

    private function serviceCatalogSchema(array $services): string {
        $serviceItems = [];

        foreach ($services as $service) {
            if (empty($service['title']) || empty($service['slug'])) {
                continue;
            }

            $serviceItems[] = [
                '@type' => 'Service',
                'name' => (string) $service['title'],
                'url' => $this->buildCanonicalUrl('/services/' . (string) $service['slug']),
            ];
        }

        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'Services',
            'itemListElement' => $serviceItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '';
    }

    private function serviceSchema(array $service, string $canonicalUrl): string {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => (string) ($service['title'] ?? 'Service'),
            'description' => trim(strip_tags(html_entity_decode((string) ($service['short_description'] ?? ''), ENT_QUOTES, 'UTF-8'))),
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Case Study Labs',
            ],
            'url' => $canonicalUrl,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '';
    }

    private function breadcrumbSchema(array $items): string {
        $listItems = [];
        $position = 1;

        foreach ($items as $item) {
            if (empty($item['name']) || empty($item['url'])) {
                continue;
            }

            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => (string) $item['name'],
                'item' => (string) $item['url'],
            ];
            $position++;
        }

        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '';
    }
}
