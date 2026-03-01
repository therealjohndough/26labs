<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\CSRF;
use App\Models\Inquiry;
use App\Models\CaseStudy;
use App\Models\Post;
use App\Models\Service;
use App\Models\Stat;

class AdminController {
    public function dashboard(): void {
        Auth::requireAuth();

        $unreadInquiries = Inquiry::countUnread();
        $caseStudies = CaseStudy::all();
        $posts = Post::all();
        $inquiries = Inquiry::all(10);

        $this->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'user' => Auth::getUser(),
            'unreadInquiries' => $unreadInquiries,
            'caseStudies' => $caseStudies,
            'posts' => $posts,
            'inquiries' => $inquiries,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudies(): void {
        Auth::requireAuth();

        $caseStudies = CaseStudy::all();

        $this->render('admin/case-studies/list', [
            'title' => 'Case Studies',
            'user' => Auth::getUser(),
            'caseStudies' => $caseStudies,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudiesCreate(): void {
        Auth::requireAuth();

        $this->render('admin/case-studies/create', [
            'title' => 'Create Case Study',
            'user' => Auth::getUser(),
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudiesStore(): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        $data = [
            'title' => htmlspecialchars($_POST['title'] ?? ''),
            'client_name' => htmlspecialchars($_POST['client_name'] ?? ''),
            'description' => htmlspecialchars($_POST['description'] ?? ''),
            'tags' => htmlspecialchars($_POST['tags'] ?? ''),
            'services_provided' => htmlspecialchars($_POST['services_provided'] ?? ''),
            'year' => (int)($_POST['year'] ?? date('Y')),
        ];

        if (CaseStudy::create($data)) {
            header('Location: /admin/case-studies?success=1');
            exit;
        }

        header('Location: /admin/case-studies?error=1');
        exit;
    }

    public function caseStudiesEdit(string $id): void {
        Auth::requireAuth();

        $caseStudy = CaseStudy::find((int)$id);

        if (!$caseStudy) {
            http_response_code(404);
            exit;
        }

        $this->render('admin/case-studies/edit', [
            'title' => 'Edit Case Study',
            'user' => Auth::getUser(),
            'caseStudy' => $caseStudy,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function caseStudiesUpdate(string $id): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        $data = [
            'title' => htmlspecialchars($_POST['title'] ?? ''),
            'client_name' => htmlspecialchars($_POST['client_name'] ?? ''),
            'description' => htmlspecialchars($_POST['description'] ?? ''),
            'tags' => htmlspecialchars($_POST['tags'] ?? ''),
            'services_provided' => htmlspecialchars($_POST['services_provided'] ?? ''),
            'year' => (int)($_POST['year'] ?? date('Y')),
        ];

        if (CaseStudy::update((int)$id, $data)) {
            header('Location: /admin/case-studies?success=1');
            exit;
        }

        header('Location: /admin/case-studies?error=1');
        exit;
    }

    public function caseStudiesDelete(string $id): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        CaseStudy::delete((int)$id);
        header('Location: /admin/case-studies?success=1');
        exit;
    }

    public function inquiries(): void {
        Auth::requireAuth();

        $inquiries = Inquiry::all();

        $this->render('admin/inquiries', [
            'title' => 'Inquiries',
            'user' => Auth::getUser(),
            'inquiries' => $inquiries,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function inquiriesView(string $id): void {
        Auth::requireAuth();

        $inquiry = Inquiry::find((int)$id);

        if (!$inquiry) {
            http_response_code(404);
            exit;
        }

        Inquiry::markAsRead((int)$id);

        $this->render('admin/inquiry-detail', [
            'title' => 'View Inquiry',
            'user' => Auth::getUser(),
            'inquiry' => $inquiry,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function inquiriesDelete(string $id): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        Inquiry::delete((int)$id);
        header('Location: /admin/inquiries?success=1');
        exit;
    }

    // Services management
    public function services(): void {
        Auth::requireAuth();

        $services = Service::all();

        $this->render('admin/services/list', [
            'title' => 'Services',
            'user' => Auth::getUser(),
            'services' => $services,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function servicesCreate(): void {
        Auth::requireAuth();

        $this->render('admin/services/create', [
            'title' => 'Create Service',
            'user' => Auth::getUser(),
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function servicesStore(): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        $data = [
            'title' => htmlspecialchars($_POST['title'] ?? ''),
            'slug' => htmlspecialchars($_POST['slug'] ?? ''),
            'short_description' => htmlspecialchars($_POST['short_description'] ?? ''),
            'description' => htmlspecialchars($_POST['description'] ?? ''),
            'icon' => htmlspecialchars($_POST['icon'] ?? ''),
            'position' => (int)($_POST['position'] ?? 0),
        ];

        if (!Service::create($data)) {
            header('Location: /admin/services/create?error=1');
            exit;
        }

        header('Location: /admin/services?success=1');
        exit;
    }

    public function servicesEdit(string $id): void {
        Auth::requireAuth();

        $service = Service::find((int)$id);
        if (!$service) {
            http_response_code(404);
            exit;
        }

        $this->render('admin/services/edit', [
            'title' => 'Edit Service',
            'user' => Auth::getUser(),
            'service' => $service,
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function servicesUpdate(string $id): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        $service = Service::find((int)$id);
        if (!$service) {
            http_response_code(404);
            exit;
        }

        $data = [
            'title' => htmlspecialchars($_POST['title'] ?? ''),
            'slug' => htmlspecialchars($_POST['slug'] ?? ''),
            'short_description' => htmlspecialchars($_POST['short_description'] ?? ''),
            'description' => htmlspecialchars($_POST['description'] ?? ''),
            'icon' => htmlspecialchars($_POST['icon'] ?? ''),
            'position' => (int)($_POST['position'] ?? 0),
        ];

        if (!Service::update((int)$id, $data)) {
            header('Location: /admin/services/' . $id . '/edit?error=1');
            exit;
        }

        header('Location: /admin/services?success=1');
        exit;
    }

    public function servicesDelete(string $id): void {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        Service::delete((int)$id);
        header('Location: /admin/services?success=1');
        exit;
    }

    private function render(string $view, array $data = []): void {
        extract($data);
        require __DIR__ . '/../../views/' . $view . '.php';
    }
}
