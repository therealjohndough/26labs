<?php
// HomePage for Case Study Labs
// Variables passed: $services, $case_studies
$services = $services ?? [];
$case_studies = $case_studies ?? [];
?>

<!-- Hero Section -->
<section class="min-h-screen flex flex-col justify-end px-12 py-20 border-b border-border relative overflow-hidden">

  <div class="relative z-10">
    <!-- Eyebrow -->
    <div class="mb-10 flex items-center gap-2" style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.18em; color: #888888; text-transform: uppercase;">
      <span style="display: inline-block; width: 6px; height: 6px; background: #D9FF5C; border-radius: 50%; flex-shrink: 0;"></span>
      BUFFALO, NY — EST. 2016
    </div>

    <!-- Headline — two lines, staggered in via JS -->
    <h1 class="mb-10" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(52px, 7vw, 88px); line-height: 1.05; color: #FFFFFF; margin-bottom: 40px;">
      <span class="hero-line" style="display: block; opacity: 0; transform: translateY(24px);">Strategy you</span>
      <span class="hero-line" style="display: block; opacity: 0; transform: translateY(24px);">can deploy.</span>
    </h1>

    <!-- Subheading -->
    <p class="mb-12" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.65; color: #E8E8E8; max-width: 480px; margin-bottom: 48px;">
      Founded in 2016 in Buffalo, NY — strategic design and brand elevation for cannabis and lifestyle leaders. We build brands that define categories, command attention, and drive revenue.
    </p>

    <!-- CTA Buttons -->
    <div class="flex gap-5 items-center">
      <a href="/contact" style="font-family: 'lores-15', monospace; font-weight: 700; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; background: #D9FF5C; color: #1A1A1A; padding: 14px 32px; text-decoration: none; display: inline-block; transition: background 150ms ease-out;">
        START A PROJECT →
      </a>
      <a href="/services" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">
        See Our Work ↗
      </a>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-20 right-12" style="writing-mode: vertical-rl; transform: rotate(180deg); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10px; letter-spacing: 0.14em; color: #888888; text-transform: uppercase;">
    Scroll
  </div>

</section>

<!-- Trust Bar -->
<div class="px-12 py-8 border-b border-border flex items-center gap-20 overflow-auto">
  <span class="text-xs tracking-widest text-text-secondary/50 uppercase whitespace-nowrap flex-shrink-0">Trusted By</span>
  <div class="flex gap-16 flex-nowrap">
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">StockX</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">High Times</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">Real Madrid</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">Zoe Wilder</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">Buffalo Cannabis Network</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">House of Sacci</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">Eat Off Art</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">Skyworld</span>
    <span class="text-sm tracking-wider text-text-secondary/45 font-semibold whitespace-nowrap">The Other</span>
  </div>
</div>

<!-- Stats Section — Direction 01 scoreboard -->
<section style="border-top: 1px solid rgba(245,242,238,0.08); border-bottom: 1px solid rgba(245,242,238,0.08);">
  <div class="px-12" style="padding-top: 80px; padding-bottom: 80px;">
    <div class="grid grid-cols-4" style="gap: 0;">

      <div style="padding-right: 48px; border-right: 1px solid rgba(245,242,238,0.08);">
        <div class="stat-number" data-target="300" data-suffix="+"
          style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: 96px; line-height: 1; color: #D9FF5C; margin-bottom: 16px;">
          300+
        </div>
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.16em; color: #888888; text-transform: uppercase; line-height: 1.5;">
          PRODUCTS<br>LAUNCHED
        </div>
      </div>

      <div style="padding-left: 48px; padding-right: 48px; border-right: 1px solid rgba(245,242,238,0.08);">
        <div class="stat-number" data-target="100" data-suffix="%"
          style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: 96px; line-height: 1; color: #D9FF5C; margin-bottom: 16px;">
          100%
        </div>
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.16em; color: #888888; text-transform: uppercase; line-height: 1.5;">
          FOUNDER-LED<br>PROJECTS
        </div>
      </div>

      <div style="padding-left: 48px; padding-right: 48px; border-right: 1px solid rgba(245,242,238,0.08);">
        <div class="stat-number" data-target="0" data-suffix=""
          style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: 96px; line-height: 1; color: #D9FF5C; margin-bottom: 16px;">
          0
        </div>
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.16em; color: #888888; text-transform: uppercase; line-height: 1.5;">
          OCM<br>FAILURES
        </div>
      </div>

      <div style="padding-left: 48px;">
        <div class="stat-number" data-target="1000" data-suffix="+"
          style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: 96px; line-height: 1; color: #D9FF5C; margin-bottom: 16px;">
          1,000+
        </div>
        <div style="font-family: 'lores-9-narrow', monospace; font-weight: 700; font-size: 11px; letter-spacing: 0.16em; color: #888888; text-transform: uppercase; line-height: 1.5;">
          RETAIL<br>TOUCHPOINTS
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Services Section -->
<section class="border-b border-border" id="services">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">
      <span class="inline-block w-2 h-2 bg-accent rounded-full align-middle mr-2"></span>
      What We Do
    </div>

    <div class="grid grid-cols-2 gap-24 mb-20">
      <h2 class="font-serif text-4xl md:text-5xl font-normal leading-tight">Crafting premium brands that move culture and convert buyers.</h2>
      <p class="text-base text-text-secondary leading-relaxed self-end">We don't do theoretical frameworks. Every engagement ends in deployed strategy, real assets, and measurable impact. For cannabis, lifestyle, and the brands that dare to lead.</p>
    </div>

    <div class="space-y-0">
      <?php foreach ($services as $i => $service): $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?>
      <a href="/services/<?= htmlspecialchars($service['slug'] ?? '') ?>" class="grid grid-cols-[56px_1fr_200px_80px] gap-8 py-9 border-t border-border hover:bg-white/2 transition">
        <span class="text-xs tracking-widest text-text-secondary/20"><?= $num ?></span>
        <span class="font-serif text-2xl font-normal"><?= htmlspecialchars($service['title']) ?></span>
        <span class="text-xs text-text-secondary/35 leading-relaxed"><?= htmlspecialchars(substr($service['short_description'] ?? '', 0, 80)) ?> ...</span>
        <span class="text-right text-lg text-text-secondary/20 hover:text-accent transition">↗</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Work Section -->
<section class="border-b border-border" id="work">
  <div class="px-12 py-24">
    <div class="flex justify-between items-end mb-16">
      <div class="text-xs tracking-widest text-text-secondary/50 uppercase">
        <span class="inline-block w-2 h-2 bg-accent rounded-full align-middle mr-2"></span>
        Selected Work
      </div>
      <a href="/work" class="text-xs tracking-widest text-text-secondary/50 hover:text-white uppercase border-b border-text-secondary/25 pb-0.5">View All Cases</a>
    </div>

    <h2 class="font-serif text-4xl md:text-5xl font-normal leading-tight mb-16 max-w-3xl">We deliver outcomes,<br>not services.</h2>

    <div class="grid grid-cols-3 gap-0.5 bg-mid">
      <?php foreach (array_slice($case_studies, 0, 6) as $i => $study): ?>
      <div class="aspect-video bg-mid relative overflow-hidden group cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-800 group-hover:scale-105 transition-transform duration-500"></div>
        <div class="absolute bottom-6 left-6 right-6 group-hover:opacity-0 transition-opacity">
          <div class="font-serif text-lg"><?= htmlspecialchars($study['title']) ?></div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
          <div class="text-xs tracking-widest text-accent uppercase mb-2">Branding · Web · Strategy</div>
          <div class="font-serif text-lg mb-1"><?= htmlspecialchars($study['title']) ?></div>
          <div class="text-xs text-text-secondary/65"><?= htmlspecialchars(substr($study['description'] ?? '', 0, 100)) ?>...</div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Values Section -->
<section class="border-b border-border" id="studio">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">
      <span class="inline-block w-2 h-2 bg-accent rounded-full align-middle mr-2"></span>
      Our Lab Values
    </div>

    <h2 class="font-serif text-4xl md:text-5xl font-normal leading-tight max-w-2xl mb-24">Made to Inspire.<br>Built to deploy.</h2>

    <div class="grid grid-cols-3 gap-0 border-b border-border">
      <div class="pb-12 pr-10 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-5">01</div>
        <div class="font-serif text-2xl font-normal mb-3">Taste is Strategy</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">Design isn't decoration — it's direction. How your brand looks tells the market what to think about how you operate.</div>
      </div>
      <div class="pb-12 px-10 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-5">02</div>
        <div class="font-serif text-2xl font-normal mb-3">Clarity is Currency</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">Clear brands grow. We remove the noise and sharpen your signal until every asset earns its place.</div>
      </div>
      <div class="pb-12 pl-10">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-5">03</div>
        <div class="font-serif text-2xl font-normal mb-3">Collaboration Over Control</div>
        <div class="text-sm text-text-secondary/45 leading-relaxed">We co-create, not babysit. The best work happens when founders stay in the room and trust the process.</div>
      </div>
    </div>
  </div>
</section>

<!-- Fit Check Section -->
<section class="border-b border-border">
  <div class="grid grid-cols-2 gap-0.5">
    <div class="px-12 py-24 bg-white/3">
      <div class="text-xs tracking-widest text-accent uppercase mb-10">A Good Fit</div>
      <div class="space-y-5">
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">You see design as a business multiplier</div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">You value speed, taste, and strategy</div>
        <div class="pb-5 border-b border-border text-base text-text-secondary/70">You want to build legacy — not chase hype</div>
        <div class="text-base text-text-secondary/70">You're in cannabis, lifestyle, or an emerging space</div>
      </div>
    </div>

    <div class="px-12 py-24 bg-white/1">
      <div class="text-xs tracking-widest text-text-secondary/30 uppercase mb-10">Not a Good Fit</div>
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
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-serif text-9xl text-white opacity-5 pointer-events-none whitespace-nowrap" style="font-size: clamp(100px, 18vw, 260px); white-space: nowrap;">Deploy</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>Ready when you are
    </div>
    <h2 class="font-serif text-5xl md:text-6xl font-normal leading-tight max-w-3xl mx-auto mb-10">Let's build something the market won't forget.</h2>
    <div class="flex gap-5 justify-center">
      <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">Send a Message</a>
      <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">Book a Discovery Call ↗</a>
    </div>
  </div>
</section>
