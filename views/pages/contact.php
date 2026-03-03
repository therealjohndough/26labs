<?php
// Contact Page
?>

<!-- Contact Hero -->
<section class="min-h-screen px-12 py-32 flex items-center justify-center border-b border-border relative overflow-hidden">
  <!-- Background text -->
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); user-select: none;">Contact</div>

  <div class="relative z-10 max-w-2xl w-full text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Let's Connect
    </div>
    
    <h1 class="leading-tight mb-8" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(32px, 4.5vw, 60px); color: #FFFFFF;">
      Let's talk. No strings attached.
    </h1>

    <p class="text-base text-text-secondary leading-relaxed mb-12">
      We respond to every serious inquiry within 24 hours. If you're a fit, we'll know quickly. If you're not, we'll tell you honestly and point you somewhere that might be.
    </p>

    <!-- Contact Options -->
    <div class="grid grid-cols-2 gap-12 mb-16">
      <!-- Email -->
      <div>
        <div class="text-xs tracking-widest text-text-secondary/30 uppercase mb-4">Email</div>
        <a href="mailto:dough@casestudy-labs.com" class="text-white hover:text-accent transition" style="font-family: 'lores-15', monospace; font-weight: 700; font-size: clamp(14px, 1.5vw, 20px); letter-spacing: 0.04em;">
          dough@casestudy-labs.com
        </a>
        <p class="text-xs text-text-secondary/45 mt-2">(Only official inbox)</p>
      </div>

      <!-- Calendar -->
      <div>
        <div class="text-xs tracking-widest text-text-secondary/30 uppercase mb-4">Book a Call</div>
        <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="text-white hover:text-accent transition" style="font-family: 'lores-15', monospace; font-weight: 700; font-size: clamp(14px, 1.5vw, 20px); letter-spacing: 0.04em;">
          Google Calendar ↗
        </a>
        <p class="text-xs text-text-secondary/45 mt-2">(30 min discovery call)</p>
      </div>
    </div>

    <!-- Social -->
    <div class="pt-12 border-t border-border">
      <div class="text-xs tracking-widest text-text-secondary/30 uppercase mb-6">Follow Along</div>
      <div class="flex justify-center gap-12">
        <a href="https://www.instagram.com/case_study_labs/" target="_blank" class="text-sm text-text-secondary/45 hover:text-white transition">
          Instagram <span class="text-text-secondary/25">↗</span>
        </a>
        <a href="https://www.linkedin.com/company/case-study-labs" target="_blank" class="text-sm text-text-secondary/45 hover:text-white transition">
          LinkedIn <span class="text-text-secondary/25">↗</span>
        </a>
        <a href="https://www.linkedin.com/in/therealjohndough" target="_blank" class="text-sm text-text-secondary/45 hover:text-white transition">
          Founder <span class="text-text-secondary/25">↗</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Inquiry Form -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="grid grid-cols-2 gap-24">

      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-6" style="display: inline-flex; align-items: center; gap: 8px;">
          <i class="hn hn-envelope" style="font-size: 11px; color: #D9FF5C; line-height: 1;"></i>
          Send an Inquiry
        </div>
        <h2 class="leading-tight mb-6" style="font-family: 'lores-9-wide-bold-alt-oaklan', monospace; font-weight: 400; font-size: clamp(22px, 3vw, 40px); color: #FFFFFF;">Tell us what<br>you're building.</h2>
        <p class="text-sm leading-relaxed" style="color: #888888; max-width: 320px;">We read every inquiry personally. If there's a fit, you'll hear from us within 24 hours.</p>
      </div>

      <form id="inquiryForm" class="space-y-5" novalidate>
        <input type="hidden" name="<?php echo htmlspecialchars($csrf_field ?? '_token'); ?>" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>">

        <div class="grid grid-cols-2 gap-5">
          <div>
            <label class="inquiry-label">Name *</label>
            <input type="text" name="name" required class="inquiry-input" placeholder="Your name">
          </div>
          <div>
            <label class="inquiry-label">Company</label>
            <input type="text" name="company" class="inquiry-input" placeholder="Brand or company">
          </div>
        </div>

        <div>
          <label class="inquiry-label">Email *</label>
          <input type="email" name="email" required class="inquiry-input" placeholder="your@email.com">
        </div>

        <div>
          <label class="inquiry-label">Services Interested In</label>
          <div class="grid grid-cols-2 gap-2 mt-2">
            <?php foreach (['Brand Strategy', 'Branding & Production', 'Web Design', 'Media Buying', 'Content & Social', 'Lifecycle Marketing'] as $svc): ?>
            <label class="inquiry-checkbox">
              <input type="checkbox" name="services[]" value="<?php echo htmlspecialchars($svc); ?>">
              <span><?php echo htmlspecialchars($svc); ?></span>
            </label>
            <?php endforeach; ?>
          </div>
        </div>

        <div>
          <label class="inquiry-label">Budget Range</label>
          <select name="budget" class="inquiry-input">
            <option value="">Select a range...</option>
            <option value="under-5k">Under $5K</option>
            <option value="5k-15k">$5K – $15K</option>
            <option value="15k-30k">$15K – $30K</option>
            <option value="30k-plus">$30K+</option>
            <option value="not-sure">Not sure yet</option>
          </select>
        </div>

        <div>
          <label class="inquiry-label">Message *</label>
          <textarea name="message" required rows="5" class="inquiry-input" placeholder="Tell us about your project, timeline, and goals..."></textarea>
        </div>

        <div>
          <button type="submit" class="inquiry-submit" id="inquiry-submit">
            Send Inquiry <i class="hn hn-arrow-right" style="font-size: 13px; margin-left: 6px;"></i>
          </button>
        </div>

        <div id="formMessage" style="display: none;"></div>
      </form>

    </div>
  </div>
</section>

<!-- Why Work With Us -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="grid grid-cols-2 gap-24">
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-12">Why Case Study Labs</div>
        <h2 class="font-serif text-3xl md:text-4xl font-normal leading-tight mb-8">We don't chase clients.<br>We partner with founders.</h2>
        <p class="text-base text-text-secondary/55 leading-relaxed">We're selective. We turn down work that doesn't align. That's not arrogance — it's respect. For your time, your vision, and your budget.</p>
      </div>

      <div class="space-y-6">
        <div class="pb-6 border-b border-border">
          <h3 class="font-semibold text-white mb-2">25+ Years Deep</h3>
          <p class="text-sm text-text-secondary/45">Experience in sales, marketing, strategy, and brand across industries.</p>
        </div>
        <div class="pb-6 border-b border-border">
          <h3 class="font-semibold text-white mb-2">Cannabis Experts</h3>
          <p class="text-sm text-text-secondary/45">In the industry since 2003. We know the compliance landscape, the buyer behavior, and the category better than anyone.</p>
        </div>
        <div class="pb-6 border-b border-border">
          <h3 class="font-semibold text-white mb-2">Deployed Work</h3>
          <p class="text-sm text-text-secondary/45">$2M+ in ad spend managed. Zero decks that sit on shelves. Everything we build goes live.</p>
        </div>
        <div>
          <h3 class="font-semibold text-white mb-2">Real Partnership</h3>
          <p class="text-sm text-text-secondary/45">We embed with your team. You stay in the room. The best work happens when founders and creatives trust each other.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Expected Timeline -->
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-16">What to Expect</div>
    
    <div class="grid grid-cols-4 gap-0 border-b border-border">
      <div class="pb-12 pr-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4 font-semibold">Week 1</div>
        <h3 class="font-serif text-lg font-normal mb-3">Discovery Call</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">30-min Google Meet. We ask tough questions about your brand, market, and goals.</p>
      </div>
      <div class="pb-12 px-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4 font-semibold">Week 1-2</div>
        <h3 class="font-serif text-lg font-normal mb-3">Proposal</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">If it's a fit, we send a custom proposal with scope, timeline, and investment.</p>
      </div>
      <div class="pb-12 px-8 border-r border-border">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4 font-semibold">Week 3+</div>
        <h3 class="font-serif text-lg font-normal mb-3">Kickoff</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Once you say yes, we kick off immediately. Full engagement focused on results.</p>
      </div>
      <div class="pb-12 pl-8">
        <div class="text-xs tracking-widest text-text-secondary/20 mb-4 font-semibold">Month 2+</div>
        <h3 class="font-serif text-lg font-normal mb-3">Delivery</h3>
        <p class="text-sm text-text-secondary/40 leading-relaxed">Weekly check-ins, monthly reviews, and handoff materials your team can use.</p>
      </div>
    </div>
  </div>
</section>

<!-- Final CTA -->
<section class="relative overflow-hidden">
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); user-select: none;">Go</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Ready to Begin
    </div>
    <h2 class="font-serif text-5xl md:text-6xl font-normal leading-tight max-w-3xl mx-auto mb-10">
      Great brands aren't<br>built in a vacuum.
    </h2>
    <div class="flex gap-5 justify-center">
      <a href="mailto:dough@casestudy-labs.com" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition">
        Send a Message
      </a>
      <a href="https://calendar.app.google/wjzdm2J4EUE1oxh36" target="_blank" class="text-text-secondary text-xs tracking-widest uppercase border-b border-text-secondary/25 pb-0.5 hover:text-white hover:border-white transition">
        Schedule a Call ↗
      </a>
    </div>
  </div>
</section>
