<?php
// Main Navigation
// Used in app.php layout
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<nav class="fixed top-0 left-0 right-0 z-50 px-12 py-6 border-b border-border backdrop-blur-xl bg-black/85" id="site-nav">
  <div class="flex items-center justify-between">
    <!-- Logo -->
    <a href="/" style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #FFFFFF; text-decoration: none;">
      CASE_STUDY_LABS
    </a>

    <!-- Nav Links — .nav-links: flex on desktop, hidden on mobile (style.css) -->
    <ul class="nav-links">
      <li><a href="/" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= $currentPath === '/' ? 'text-white' : '' ?>">Home</a></li>
      <li><a href="/services" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= strpos($currentPath, '/services') === 0 ? 'text-white' : '' ?>">Services</a></li>
      <li><a href="/contact" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= $currentPath === '/contact' ? 'text-white' : '' ?>">Contact</a></li>
      <li><a href="/admin/login" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition">Admin</a></li>
    </ul>

    <!-- CTA — always visible (logo + CTA on mobile) -->
    <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.12em; text-transform: uppercase; background: #D9FF5C; color: #1A1A1A; padding: 10px 20px; text-decoration: none; transition: background 150ms ease-out; display: inline-flex; align-items: center; gap: 7px;">
      <i class="hn hn-calender" style="font-size: 13px;"></i> Schedule
    </a>
  </div>
</nav>

