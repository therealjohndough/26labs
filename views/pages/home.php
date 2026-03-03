<?php
// HomePage for Case Study Labs
// Variables passed: $services, $case_studies
$services = $services ?? [];
$case_studies = $case_studies ?? ($caseStudies ?? []);
?>

<!-- Hero Section -->
<section class="hero-section min-h-screen flex flex-col justify-end py-20 border-b border-border relative overflow-hidden">

  <!-- "26" watermark — large pixel numeral, sits behind all content -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none" style="z-index: 0;">
    <div style="position: absolute; right: -3%; top: 50%; transform: translateY(-50%); font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: clamp(240px, 26vw, 440px); color: rgba(255,255,255,0.022); line-height: 1; user-select: none; white-space: nowrap; letter-spacing: -0.02em;">26</div>
  </div>

  <div class="relative z-10">
    <!-- Eyebrow -->
    <div class="mb-10 flex items-center gap-2" style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.18em; color: #888888; text-transform: uppercase;">
      <i class="hn hn-sparkles" style="font-size: 11px; color: #D9FF5C; line-height: 1;"></i>
      BUFFALO, NY — EST. 2016
    </div>

    <!-- Headline — two lines, staggered in via JS -->
    <h1 class="hero-headline">
      <span class="hero-line" style="display: block;">Strategy you</span>
      <span class="hero-line" style="display: block;">can deploy.</span>
    </h1>

    <!-- Subheading -->
    <p class="hero-body">
      Founded in 2016 in Buffalo, NY — strategic design and brand elevation for cannabis and lifestyle leaders. We build brands that define categories, command attention, and drive revenue.
    </p>

    <!-- CTA Buttons — .cta-group: stacked mobile, row desktop (style.css) -->
    <div class="cta-group">
      <a href="/contact" class="hero-cta-primary">
        START A PROJECT <i class="hn hn-arrow-right" style="margin-left: 6px;"></i>
      </a>
      <a href="/work" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition" style="display: inline-flex; align-items: center; gap: 6px;">
        See Our Work <i class="hn hn-external-link" style="font-size: 12px;"></i>
      </a>
    </div>
  </div>

  <!-- Scroll indicator — .desktop-only: hidden mobile, block desktop (style.css) -->
  <div class="desktop-only absolute bottom-20 right-12" style="writing-mode: vertical-rl; transform: rotate(180deg); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10px; letter-spacing: 0.14em; color: #888888; text-transform: uppercase;">
    Scroll
  </div>

</section>

<!-- Trust Bar — pinned label + auto-scrolling marquee -->
<div class="px-12 py-8 border-b border-border flex items-center gap-12 overflow-hidden">
  <span style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 10px; letter-spacing: 0.2em; color: rgba(245,242,238,0.25); text-transform: uppercase; white-space: nowrap; flex-shrink: 0;">Trusted By</span>
  <div class="marquee-container">
    <div class="marquee-track">
      <span class="marquee-item">StockX</span>
      <span class="marquee-item">High Times</span>
      <span class="marquee-item">Real Madrid</span>
      <span class="marquee-item">Zoe Wilder</span>
      <span class="marquee-item">Buffalo Cannabis Network</span>
      <span class="marquee-item">House of Sacci</span>
      <span class="marquee-item">Eat Off Art</span>
      <span class="marquee-item">Skyworld</span>
      <span class="marquee-item">The Other</span>
      <!-- Duplicate for seamless loop -->
      <span class="marquee-item" aria-hidden="true">StockX</span>
      <span class="marquee-item" aria-hidden="true">High Times</span>
      <span class="marquee-item" aria-hidden="true">Real Madrid</span>
      <span class="marquee-item" aria-hidden="true">Zoe Wilder</span>
      <span class="marquee-item" aria-hidden="true">Buffalo Cannabis Network</span>
      <span class="marquee-item" aria-hidden="true">House of Sacci</span>
      <span class="marquee-item" aria-hidden="true">Eat Off Art</span>
      <span class="marquee-item" aria-hidden="true">Skyworld</span>
      <span class="marquee-item" aria-hidden="true">The Other</span>
    </div>
  </div>
</div>

<!-- Stats Section — scroll on mobile, grid on desktop -->
<section class="stats-section">
  <div class="stats-scroll" id="stats-scroll">

    <div class="stat-card">
      <div class="stat-number" data-target="350" data-suffix="+">350+</div>
      <div class="stat-label">PRODUCTS<br>LAUNCHED IN NYS</div>
    </div>

    <div class="stat-card">
      <div class="stat-number" data-target="100" data-suffix="%">100%</div>
      <div class="stat-label">FOUNDER-LED<br>PROJECTS</div>
    </div>

    <div class="stat-card">
      <div class="stat-number" data-target="0" data-suffix="">0</div>
      <div class="stat-label">OCM<br>RECALLS</div>
    </div>

    <div class="stat-card">
      <div class="stat-number" data-target="1000" data-suffix="+">1,000+</div>
      <div class="stat-label">RETAIL<br>TOUCHPOINTS</div>
    </div>

  </div>
  <div class="stats-dots" id="stats-dots">
    <div class="stats-dot active"></div>
    <div class="stats-dot"></div>
    <div class="stats-dot"></div>
    <div class="stats-dot"></div>
  </div>
</section>

<!-- Services Section -->
<section class="border-b border-border" id="services">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16" style="display: inline-flex; align-items: center; gap: 8px;">
      <i class="hn hn-bolt" style="font-size: 11px; color: #D9FF5C; line-height: 1;"></i>
      What We Do
    </div>

    <div class="grid grid-cols-2 gap-24 mb-20">
      <h2 style="font-family: 'lores-9-wide-bold-alt-oaklan', monospace; font-weight: 400; font-size: clamp(22px, 3vw, 44px); line-height: 1.25; color: #FFFFFF;">Crafting premium brands that move culture and convert buyers.</h2>
      <p class="text-base text-text-secondary leading-relaxed self-end">We don't do theoretical frameworks. Every engagement ends in deployed strategy, real assets, and measurable impact. For cannabis, lifestyle, and the brands that dare to lead.</p>
    </div>

    <div class="space-y-0">
      <?php foreach ($services as $i => $service): $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?>
      <a href="/services/<?= htmlspecialchars($service['slug'] ?? '') ?>" class="service-row grid grid-cols-[56px_1fr_200px_80px] gap-8 py-9 border-t border-border hover:bg-white/2 transition">
        <span class="service-num" style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 10px; letter-spacing: 0.16em; color: rgba(245,242,238,0.2);"><?= $num ?></span>
        <span style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 18px; color: #FFFFFF;"><?= htmlspecialchars($service['title']) ?></span>
        <span class="service-desc text-xs text-text-secondary/35 leading-relaxed"><?= htmlspecialchars(substr($service['short_description'] ?? '', 0, 80)) ?> ...</span>
        <span class="text-right text-text-secondary/20 hover:text-accent transition" style="font-size: 16px; line-height: 1;"><i class="hn hn-arrow-right"></i></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Work Section -->
<section class="border-b border-border" id="work">
  <div class="px-12 py-24">
    <div class="flex justify-between items-end mb-16">
      <div class="text-xs tracking-widest text-text-secondary/50 uppercase" style="display: inline-flex; align-items: center; gap: 8px;">
        <i class="hn hn-sparkles" style="font-size: 11px; color: #D9FF5C; line-height: 1;"></i>
        Selected Work
      </div>
      <a href="/contact" class="text-xs tracking-widest text-text-secondary/50 hover:text-white uppercase border-b border-text-secondary/25 pb-0.5" style="display: inline-flex; align-items: center; gap: 6px;">Start a Project <i class="hn hn-arrow-right" style="font-size: 11px;"></i></a>
    </div>

    <h2 style="font-family: 'lores-9-wide-bold-alt-oaklan', monospace; font-weight: 400; font-size: clamp(22px, 3vw, 44px); line-height: 1.25; color: #FFFFFF; margin-bottom: 64px; max-width: 48rem;">We deliver outcomes,<br>not services.</h2>

    <div class="grid grid-cols-3 gap-0.5 bg-mid">
      <?php foreach (array_slice($case_studies, 0, 6) as $i => $study): ?>
      <a href="/work/<?= htmlspecialchars($study['slug'] ?? '') ?>" class="aspect-video bg-mid relative overflow-hidden group cursor-pointer block">
        <?php if (!empty($study['hero_image'])): ?>
        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= htmlspecialchars($study['hero_image']) ?>');"></div>
        <div class="absolute inset-0 bg-black/40"></div>
        <?php else: ?>
        <div class="absolute inset-0 group-hover:scale-105 transition-transform duration-500" style="background:
          radial-gradient(circle at 20% 20%, rgba(184, 255, 92, 0.22), transparent 32%),
          radial-gradient(circle at 78% 18%, rgba(255, 214, 94, 0.16), transparent 28%),
          linear-gradient(135deg, #0b3f39 0%, #14564d 42%, #1f2c27 100%);"></div>
        <div class="absolute inset-0 opacity-20" style="background-image:
          linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
          linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
          background-size: 28px 28px;"></div>
        <?php endif; ?>
        <div class="absolute bottom-6 left-6 right-6 group-hover:opacity-0 transition-opacity">
          <div class="font-serif text-lg"><?= htmlspecialchars($study['title']) ?></div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
          <div class="text-xs tracking-widest text-accent uppercase mb-2">Branding · Web · Strategy</div>
          <div class="font-serif text-lg mb-1"><?= htmlspecialchars($study['title']) ?></div>
          <div class="text-xs text-text-secondary/65"><?= htmlspecialchars(substr($study['description'] ?? '', 0, 100)) ?>...</div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Values Section -->
<section class="border-b border-border" id="studio">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16" style="display: inline-flex; align-items: center; gap: 8px;">
      <i class="hn hn-check-circle" style="font-size: 11px; color: #D9FF5C; line-height: 1;"></i>
      Our Lab Values
    </div>

    <h2 style="font-family: 'lores-9-wide-bold-alt-oaklan', monospace; font-weight: 400; font-size: clamp(22px, 3vw, 44px); line-height: 1.25; color: #FFFFFF; max-width: 36rem; margin-bottom: 64px;">Made to Inspire.<br>Built to deploy.</h2>

    <div class="grid grid-cols-3 gap-0 border-b border-border">
      <div class="values-item pb-12 pr-10 border-r border-border">
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 10px; letter-spacing: 0.2em; color: rgba(245,242,238,0.2); margin-bottom: 20px;">01</div>
        <div style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 18px; color: #FFFFFF; margin-bottom: 12px;">Taste is Strategy</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">Design isn't decoration — it's direction. How your brand looks tells the market what to think about how you operate.</div>
      </div>
      <div class="values-item pb-12 px-10 border-r border-border">
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 10px; letter-spacing: 0.2em; color: rgba(245,242,238,0.2); margin-bottom: 20px;">02</div>
        <div style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 18px; color: #FFFFFF; margin-bottom: 12px;">Clarity is Currency</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">Clear brands grow. We remove the noise and sharpen your signal until every asset earns its place.</div>
      </div>
      <div class="values-item pb-12 pl-10">
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 10px; letter-spacing: 0.2em; color: rgba(245,242,238,0.2); margin-bottom: 20px;">03</div>
        <div style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 18px; color: #FFFFFF; margin-bottom: 12px;">Collaboration Over Control</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">We co-create, not babysit. The best work happens when founders stay in the room and trust the process.</div>
      </div>
    </div>
  </div>
</section>

<!-- Fit Check Section -->
<section class="border-b border-border">
  <div class="grid grid-cols-2 gap-0.5">
    <div class="fit-panel px-12 py-24 bg-white/3">
      <div class="text-xs tracking-widest text-accent uppercase mb-10" style="display: inline-flex; align-items: center; gap: 8px;"><i class="hn hn-check-circle" style="font-size: 11px; line-height: 1;"></i>A Good Fit</div>
      <div class="space-y-5">
        <div class="pb-5 border-b border-border text-base text-text-secondary/70" style="display: flex; align-items: flex-start; gap: 10px;"><i class="hn hn-check" style="font-size: 12px; color: #D9FF5C; line-height: 1.4; flex-shrink: 0;"></i><span>You see design as a business multiplier</span></div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70" style="display: flex; align-items: flex-start; gap: 10px;"><i class="hn hn-check" style="font-size: 12px; color: #D9FF5C; line-height: 1.4; flex-shrink: 0;"></i><span>You value speed, taste, and strategy</span></div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70" style="display: flex; align-items: flex-start; gap: 10px;"><i class="hn hn-check" style="font-size: 12px; color: #D9FF5C; line-height: 1.4; flex-shrink: 0;"></i><span>You want to build legacy — not chase hype</span></div>
        <div class="text-base text-text-secondary/70" style="display: flex; align-items: flex-start; gap: 10px;"><i class="hn hn-check" style="font-size: 12px; color: #D9FF5C; line-height: 1.4; flex-shrink: 0;"></i><span>You're in cannabis, lifestyle, or an emerging space</span></div>
      </div>
    </div>

    <div class="fit-panel px-12 py-24 bg-white/1">
      <div class="text-xs tracking-widest text-text-secondary/30 uppercase mb-10" style="display: inline-flex; align-items: center; gap: 8px;"><i class="hn hn-bolt" style="font-size: 11px; line-height: 1;"></i>Not a Good Fit</div>
      <div class="space-y-5">
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">Micromanagers and design-by-committee</div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">"Just need a quick logo" shoppers</div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">Startups with no direction or no budget</div>
        <div class="text-base text-text-secondary/70">Brands unwilling to evolve their positioning</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="border-b border-border relative overflow-hidden">
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); white-space: nowrap; user-select: none;">Deploy</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <i class="hn hn-bolt" style="font-size: 11px; line-height: 1;"></i>Ready when you are
    </div>
    <h2 style="font-family: 'lores-22-serif', monospace; font-weight: 700; font-size: clamp(28px, 4vw, 56px); line-height: 1.15; color: #FFFFFF; max-width: 36rem; margin: 0 auto 40px;">Let's build something the market won't forget.</h2>
    <div class="cta-section-btns flex gap-5 justify-center">
      <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition" style="display: inline-flex; align-items: center; gap: 8px;"><i class="hn hn-envelope" style="font-size: 14px;"></i> Send a Message</a>
      <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition" style="display: inline-flex; align-items: center; gap: 7px;"><i class="hn hn-calender" style="font-size: 13px;"></i> Book a Discovery Call</a>
    </div>
  </div>
</section>
