# SEO Migration Checklist (casestudy-labs.com)

Use this checklist when replacing the current live site with this codebase.

## 1) Before Launch

- Keep the same primary domain: `https://casestudy-labs.com`.
- Set `APP_URL=https://casestudy-labs.com` in production `.env`.
- Build a URL mapping sheet from old site URLs to new URLs.
- Add every changed URL to [`config/redirects.php`](/workspaces/26labs/config/redirects.php) as a `301` mapping.
- Ensure page-level metadata is complete for all key pages (home, work, services, contact, each case study, each service).
- Verify `robots.txt` and `sitemap.xml` in staging:
  - `https://staging-domain/robots.txt`
  - `https://staging-domain/sitemap.xml`

## 2) Launch Day

- Deploy with redirects in place before DNS switch.
- Keep redirects indefinitely for high-value pages.
- Confirm the following return `200`:
  - `/`
  - `/work`
  - `/services`
  - `/contact`
  - `/sitemap.xml`
  - `/robots.txt`
- Confirm old URLs return `301` to the new canonical URLs.

## 3) Post-Launch SEO Protection

- Submit the new sitemap in Google Search Console and Bing Webmaster Tools.
- Use URL Inspection for top pages and request re-indexing where needed.
- Monitor for `404`, `5xx`, redirect chains, and canonical mismatches.
- Keep internal links pointing directly to final URLs (not redirected URLs).

## 4) AEO (Answer Engine Optimization)

- Keep Organization, WebSite, Service, CreativeWork, and Breadcrumb schema valid.
- Use clear question-style headings in service and case study content.
- Add concise, factual summary sections to important pages.
- Keep entity consistency: same brand name, service naming, and contact details across pages.

## 5) SEM Readiness

- Create dedicated ad landing pages only when message intent differs from organic pages.
- Ensure landing pages have unique titles/meta descriptions and strong internal links.
- Track form submissions and key CTA clicks as conversions.
- Add UTM governance rules for campaign attribution.

## 6) Guardrails

- Do not block production crawlers in `robots.txt`.
- Do not use blanket `noindex` on production templates.
- Do not remove old URLs without 301 replacements.

