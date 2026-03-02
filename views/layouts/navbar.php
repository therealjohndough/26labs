<?php
// Main Navigation
// Used in app.php layout
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<nav class="fixed top-0 left-0 right-0 z-50 px-12 py-6 border-b border-border backdrop-blur-xl bg-black/85">
  <div class="flex items-center justify-between">
    <!-- Logo -->
    <a href="/" style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #FFFFFF; text-decoration: none;">
      CASE_STUDY_LABS
    </a>

    <!-- Nav Links -->
    <ul class="flex gap-10 list-none">
      <li><a href="/" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= $currentPath === '/' ? 'text-white' : '' ?>">Home</a></li>
      <li><a href="/services" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= strpos($currentPath, '/services') === 0 ? 'text-white' : '' ?>">Services</a></li>
      <li><a href="/contact" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition <?= $currentPath === '/contact' ? 'text-white' : '' ?>">Contact</a></li>
      <li><a href="/admin/login" class="text-xs tracking-widest text-text-secondary/45 hover:text-white uppercase transition">Admin</a></li>
    </ul>

    <!-- CTA -->
    <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="bg-accent text-black px-6 py-2 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">
      Schedule
    </a>
  </div>
</nav>

