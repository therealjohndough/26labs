<?php

namespace App\Controllers;

use App\Core\Config;
use App\Models\CaseStudy;
use App\Models\Service;

class SeoController {
    public function robots(): void {
        header('Content-Type: text/plain; charset=UTF-8');

        $baseUrl = rtrim((string) Config::get('APP_URL', ''), '/');
        $isProduction = strtolower((string) Config::get('APP_ENV', 'production')) === 'production';

        if (!$isProduction) {
            echo "User-agent: *\n";
            echo "Disallow: /\n";
            return;
        }

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin/\n\n";

        if ($baseUrl !== '') {
            echo 'Sitemap: ' . $baseUrl . "/sitemap.xml\n";
        }
    }

    public function sitemap(): void {
        header('Content-Type: application/xml; charset=UTF-8');

        $baseUrl = rtrim((string) Config::get('APP_URL', ''), '/');
        if ($baseUrl === '') {
            http_response_code(500);
            echo '<?xml version="1.0" encoding="UTF-8"?><error>APP_URL must be configured for sitemap generation.</error>';
            return;
        }

        $urls = [
            $this->urlEntry($baseUrl . '/', null, 'weekly', '1.0'),
            $this->urlEntry($baseUrl . '/work', null, 'weekly', '0.9'),
            $this->urlEntry($baseUrl . '/services', null, 'weekly', '0.9'),
            $this->urlEntry($baseUrl . '/contact', null, 'monthly', '0.7'),
        ];

        foreach (Service::all() as $service) {
            if (empty($service['slug'])) {
                continue;
            }

            $urls[] = $this->urlEntry(
                $baseUrl . '/services/' . rawurlencode((string) $service['slug']),
                $this->toIsoDate($service['updated_at'] ?? $service['created_at'] ?? null),
                'monthly',
                '0.8'
            );
        }

        foreach (CaseStudy::all(1000) as $caseStudy) {
            if (empty($caseStudy['slug'])) {
                continue;
            }

            $urls[] = $this->urlEntry(
                $baseUrl . '/work/' . rawurlencode((string) $caseStudy['slug']),
                $this->toIsoDate($caseStudy['updated_at'] ?? $caseStudy['created_at'] ?? null),
                'monthly',
                '0.8'
            );
        }

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            echo $url;
        }

        echo '</urlset>';
    }

    private function urlEntry(string $loc, ?string $lastmod, string $changefreq, string $priority): string {
        $xml = '<url>';
        $xml .= '<loc>' . htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';

        if ($lastmod !== null) {
            $xml .= '<lastmod>' . htmlspecialchars($lastmod, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</lastmod>';
        }

        $xml .= '<changefreq>' . htmlspecialchars($changefreq, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</changefreq>';
        $xml .= '<priority>' . htmlspecialchars($priority, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</priority>';
        $xml .= '</url>';

        return $xml;
    }

    private function toIsoDate(mixed $value): ?string {
        if (!is_string($value) || trim($value) === '') {
            return null;
        }

        $timestamp = strtotime($value);

        if ($timestamp === false) {
            return null;
        }

        return gmdate('c', $timestamp);
    }
}
