<?php
$caseStudies = $caseStudies ?? [];
?>

<section class="px-12 py-32 border-b border-border relative overflow-hidden">
  <div class="absolute top-1/2 right-12 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(90px, 16vw, 220px); color: rgba(255,255,255,0.04); user-select: none;">Work</div>

  <div class="relative z-10 max-w-4xl">
    <div class="mb-6 text-xs font-bold tracking-wider text-accent uppercase flex items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Selected Work
    </div>
    <h1 class="leading-tight mb-8" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(32px, 4.5vw, 60px); color: #FFFFFF;">Case studies built for founders who need results, not placeholders.</h1>
    <p class="text-base text-text-secondary max-w-2xl leading-relaxed">Brand systems, web launches, and campaign deployments that move real products in competitive markets.</p>
  </div>
</section>

<section class="border-b border-border">
  <div class="px-12 py-24">
    <?php if ($caseStudies): ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0.5 bg-mid">
      <?php foreach ($caseStudies as $study): ?>
      <a href="/work/<?php echo htmlspecialchars($study['slug'] ?? ''); ?>" class="block bg-mid border border-transparent hover:border-accent transition overflow-hidden">
        <div class="aspect-video relative overflow-hidden">
          <?php if (!empty($study['hero_image'])): ?>
          <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($study['hero_image']); ?>');"></div>
          <div class="absolute inset-0 bg-black/35"></div>
          <?php else: ?>
          <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-800"></div>
          <?php endif; ?>
          <div class="absolute bottom-5 left-5 right-5">
            <div class="text-xs tracking-widest text-accent uppercase mb-2"><?php echo htmlspecialchars($study['year'] ?? ''); ?></div>
            <div class="font-serif text-xl text-white"><?php echo htmlspecialchars($study['title']); ?></div>
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-white mb-2"><?php echo htmlspecialchars($study['client_name'] ?? ''); ?></div>
          <p class="text-sm text-text-secondary/55 leading-relaxed mb-6"><?php echo htmlspecialchars(mb_substr(strip_tags(html_entity_decode($study['description'] ?? '', ENT_QUOTES, 'UTF-8')), 0, 140)); ?>...</p>
          <div class="text-xs tracking-widest text-text-secondary/40 uppercase">View Case Study ↗</div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-mid px-8 py-16 text-center text-text-secondary">Case studies will appear here once they are published.</div>
    <?php endif; ?>
  </div>
</section>
