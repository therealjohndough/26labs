<?php
// Services Hub Page for Case Study Labs
// Variables passed: $services
$services = $services ?? [];
?>

<!-- Page Hero -->
<section class="px-12 py-32 border-b border-border relative overflow-hidden">
  <!-- Background text -->
  <div class="absolute top-1/2 left-12 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(80px, 14vw, 200px); color: rgba(255,255,255,0.04); user-select: none;">Services</div>

  <div class="relative z-10">
    <div class="mb-6 text-xs font-bold tracking-wider text-accent uppercase flex items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      What We Do
    </div>
    <h1 class="leading-tight mb-10 max-w-3xl" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(32px, 4.5vw, 60px); color: #FFFFFF;">We build brands that move markets.</h1>
    <p class="text-base text-text-secondary max-w-2xl leading-relaxed mb-8">From deep strategy to deployable assets — every engagement ends in real results. No fluff. No decks that collect dust. Just work that drives revenue and builds legacy.</p>
    
    <div class="flex gap-24 text-sm">
      <div>
        <div class="mb-1" style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: clamp(28px, 3vw, 48px); color: #FFFFFF;">95%</div>
        <div class="text-text-secondary/45">of our clients are in business today</div>
      </div>
      <div>
        <div class="mb-1" style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: clamp(28px, 3vw, 48px); color: #FFFFFF;">500+</div>
        <div class="text-text-secondary/45">Products NY / CA / CO</div>
      </div>
      <div>
        <div class="mb-1" style="font-family: 'lores-9-wide', monospace; font-weight: 400; font-size: clamp(28px, 3vw, 48px); color: #FFFFFF;">25+</div>
        <div class="text-text-secondary/45">Years of Experience</div>
      </div>
    </div>
  </div>
</section>

<!-- Engagement Models -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">How We Work</div>
    
    <div class="grid grid-cols-4 gap-0.5 bg-mid">
      <div class="bg-mid p-12 border border-transparent hover:border-accent transition">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-6">01</div>
        <h3 class="font-serif text-2xl font-normal mb-3">Full Engagement</h3>
        <p class="text-sm text-text-secondary/45 leading-relaxed mb-6">End-to-end brand builds for founders ready to define their category. Strategy through deployment.</p>
        <div class="text-xs tracking-widest text-accent uppercase">Most Popular ↗</div>
      </div>
      <div class="bg-mid p-12 border border-transparent hover:border-accent transition">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-6">02</div>
        <h3 class="font-serif text-2xl font-normal mb-3">Brand Sprint</h3>
        <p class="text-sm text-text-secondary/45 leading-relaxed mb-6">4–6 week focused projects to launch or refresh a brand fast, without sacrificing quality.</p>
        <div class="text-xs tracking-widest text-accent uppercase">Fast Track ↗</div>
      </div>
      <div class="bg-mid p-12 border border-transparent hover:border-accent transition">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-6">03</div>
        <h3 class="font-serif text-2xl font-normal mb-3">Retainer</h3>
        <p class="text-sm text-text-secondary/45 leading-relaxed mb-6">Ongoing creative partnership. We embed with your team and keep your brand sharp month over month.</p>
        <div class="text-xs tracking-widest text-accent uppercase">Long-Term Growth ↗</div>
      </div>
      <div class="bg-mid p-12 border border-transparent hover:border-accent transition">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-6">04</div>
        <h3 class="font-serif text-2xl font-normal mb-3">Consulting</h3>
        <p class="text-sm text-text-secondary/45 leading-relaxed mb-6">Strategy-only engagements for teams who need direction, not execution. Plug us in, get the map.</p>
        <div class="text-xs tracking-widest text-accent uppercase">Advisory ↗</div>
      </div>
    </div>
  </div>
</section>

<!-- All Services -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">All Services</div>
    
    <div class="space-y-0">
      <?php foreach ($services as $i => $service): $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?>
      <a href="/services/<?= htmlspecialchars($service['slug'] ?? '') ?>" class="grid grid-cols-[56px_1fr_200px_80px] gap-8 py-10 border-t border-border hover:bg-white/2 transition">
        <span class="text-xs tracking-widest text-text-secondary/20"><?= $num ?></span>
        <div>
          <h3 class="font-serif text-2xl font-normal"><?= htmlspecialchars($service['title']) ?></h3>
        </div>
        <span class="text-xs text-text-secondary/35 leading-relaxed"><?= htmlspecialchars(substr($service['short_description'] ?? '', 0, 100)) ?></span>
        <span class="text-right text-lg text-text-secondary/20 hover:text-accent transition">↗</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Process -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="flex justify-between items-end mb-16">
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-4">Our Process</div>
        <h2 class="font-serif text-4xl font-normal leading-tight">How we get<br>from brief to deployed.</h2>
      </div>
    </div>
    
    <div class="grid grid-cols-5 gap-0 border-b border-border">
      <div class="pb-12 pr-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4">01</div>
        <h3 class="font-serif text-lg font-normal mb-3">Discovery</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">We audit your market, competitors, and current brand state. No assumptions — only evidence.</p>
      </div>
      <div class="pb-12 px-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4">02</div>
        <h3 class="font-serif text-lg font-normal mb-3">Strategy</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Positioning, messaging architecture, and a creative brief that aligns your team before pixel one.</p>
      </div>
      <div class="pb-12 px-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4">03</div>
        <h3 class="font-serif text-lg font-normal mb-3">Creation</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">We build with clarity and taste. Every deliverable is production-ready, not a concept deck.</p>
      </div>
      <div class="pb-12 px-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4">04</div>
        <h3 class="font-serif text-lg font-normal mb-3">Refinement</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Structured feedback rounds with clear decision gates. We move fast, not sloppy.</p>
      </div>
      <div class="pb-12 pl-8">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4">05</div>
        <h3 class="font-serif text-lg font-normal mb-3">Deploy</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Live, launched, and handed off with systems your team can actually use.</p>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">What They Say</div>
    
    <div class="grid grid-cols-3 gap-0.5 bg-mid">
      <div class="bg-mid p-12">
        <div class="w-7 h-1 bg-accent mb-6"></div>
        <p class="text-lg leading-relaxed mb-8 text-text-secondary/75">
          "They don't just design — they think. John understood our positioning problem before we finished describing it. The work practically sold itself."
        </p>
        <div class="text-sm font-semibold text-white">Michael T.</div>
        <div class="text-xs text-text-secondary/35 mt-1">Founder, Cannabis Brand · Buffalo, NY</div>
      </div>
      <div class="bg-mid p-12">
        <div class="w-7 h-1 bg-accent mb-6"></div>
        <p class="text-lg leading-relaxed mb-8 text-text-secondary/75">
          "We came in with a messy identity and left with a brand system that finally matched our ambition. The clarity they brought to our messaging was worth every dollar."
        </p>
        <div class="text-sm font-semibold text-white">Adrienne K.</div>
        <div class="text-xs text-text-secondary/35 mt-1">CMO · Lifestyle Brand</div>
      </div>
      <div class="bg-mid p-12">
        <div class="w-7 h-1 bg-accent mb-6"></div>
        <p class="text-lg leading-relaxed mb-8 text-text-secondary/75">
          "No fluff. No revisions theater. Just sharp strategy and work that actually launched. Case Study Labs is the real deal in this space."
        </p>
        <div class="text-sm font-semibold text-white">Derek W.</div>
        <div class="text-xs text-text-secondary/35 mt-1">Co-Founder · WNY Dispensary</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="border-b border-border relative overflow-hidden">
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); user-select: none;">Let's Go</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Ready When You Are
    </div>
    <h2 class="font-serif text-5xl md:text-6xl font-normal leading-tight max-w-3xl mx-auto mb-10">
      Not a fit for everyone.<br>Perfect for the right ones.
    </h2>
    <div class="flex gap-5 justify-center">
      <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">
        Start a Project
      </a>
      <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">
        Book a Discovery Call ↗
      </a>
    </div>
  </div>
</section>
