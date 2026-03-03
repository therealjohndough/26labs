<?php
// Service Detail Page
// Variables passed: $service, $case_studies
if (!isset($service) || !$service) {
    echo '<div class="px-12 py-24 text-center"><h1 class="text-2xl text-white">Service not found</h1></div>';
    return;
}

$case_studies = $case_studies ?? [];
?>

<!-- Back Link -->
<div class="px-12 pt-20 pb-8 border-b border-border">
  <a href="/services" class="inline-flex items-center gap-2 text-xs tracking-widest text-text-secondary/35 hover:text-white uppercase transition">
    <span>←</span> Back to Services
  </a>
</div>

<!-- Service Hero -->
<section class="px-12 py-32 border-b border-border">
  <div class="grid grid-cols-2 gap-24 items-end">
    <div>
      <div class="text-xs font-bold tracking-wider text-accent uppercase flex items-center gap-2 mb-6">
        <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
        <?= htmlspecialchars($service['title']) ?>
      </div>
      <h1 class="leading-tight" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(32px, 4.5vw, 60px); color: #FFFFFF;">
        The foundation everything else is built on.
      </h1>
    </div>
    <div>
      <p class="text-base text-text-secondary leading-relaxed mb-8">
        <?= htmlspecialchars($service['description'] ?? 'Premium service for delivering exceptional results.') ?>
      </p>
      <div class="flex gap-5">
        <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">
          Start a <?= htmlspecialchars($service['title']) ?> Engagement
        </a>
        <a href="/services" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">
          See All Services ↗
        </a>
      </div>
    </div>
  </div>
</section>

<!-- What We Deliver -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">What We Deliver</div>
    
    <div class="grid grid-cols-3 gap-0.5 bg-mid mb-16">
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">◎</div>
        <h3 class="font-serif text-xl font-normal mb-2">Strategic Foundation</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Deep research and clear thinking that guides every decision downstream.</p>
      </div>
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">◈</div>
        <h3 class="font-serif text-xl font-normal mb-2">Actionable Insights</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Research that becomes strategy becomes action — not reports that sit on shelves.</p>
      </div>
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">◇</div>
        <h3 class="font-serif text-xl font-normal mb-2">Custom Framework</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Built for your business, your market, your team — not a template applied.</p>
      </div>
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">▽</div>
        <h3 class="font-serif text-xl font-normal mb-2">Clear Messaging</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Every layer of your brand story articulated in language your team will actually use.</p>
      </div>
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">○</div>
        <h3 class="font-serif text-xl font-normal mb-2">Competitive Edge</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Find the whitespace. Own it. Move faster than everyone else.</p>
      </div>
      <div class="bg-mid p-12">
        <div class="text-2xl mb-4">⬡</div>
        <h3 class="font-serif text-xl font-normal mb-2">Deployment Ready</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Everything we build can be activated immediately — not six months later.</p>
      </div>
    </div>
  </div>
</section>

<!-- Who It's For -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="grid grid-cols-2 gap-24">
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-12">Who It's For</div>
        <h2 class="font-serif text-3xl md:text-4xl font-normal leading-tight mb-8">Brands at a turning point.</h2>
        
        <div class="space-y-3">
          <div class="pb-5 border-b border-border">
            <div class="text-sm font-semibold text-white">New Market Entrants</div>
            <p class="text-xs text-text-secondary/35 mt-2">Cannabis brands entering NY's adult-use market need strategy that earns shelf space and trust from day one.</p>
          </div>
          <div class="pb-5 border-b border-border">
            <div class="text-sm font-semibold text-white">Rebranding Operators</div>
            <p class="text-xs text-text-secondary/35 mt-2">Your business evolved. Your brand didn't. We realign your identity with where you're actually headed.</p>
          </div>
          <div class="pb-5">
            <div class="text-sm font-semibold text-white">Category Creators</div>
            <p class="text-xs text-text-secondary/35 mt-2">You're doing something that's never been done. We help you name it, frame it, and own it.</p>
          </div>
        </div>
      </div>
      
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-12">What's Included</div>
        <div class="space-y-3">
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Discovery Workshop (2-day)</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Competitor Audit Report</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Audience Persona Maps</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Positioning Statement</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Messaging Framework</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 border-b border-border flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Verbal Identity Guide</span>
            <span class="text-accent">✓</span>
          </div>
          <div class="pb-3 flex justify-between items-center">
            <span class="text-sm text-text-secondary/70">Handoff + Activation Guide</span>
            <span class="text-accent">✓</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Band -->
<section class="border-b border-border relative overflow-hidden">
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); user-select: none;">Strategy</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Let's Talk
    </div>
    <h2 class="font-serif text-5xl md:text-6xl font-normal leading-tight max-w-3xl mx-auto mb-10">
      Ready to get clear<br>and start winning?
    </h2>
    <div class="flex gap-5 justify-center">
      <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">
        Start a <?= htmlspecialchars($service['title']) ?> Engagement
      </a>
      <a href="/services" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">
        See All Services ↗
      </a>
    </div>
  </div>
</section>
