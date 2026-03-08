<?php
$caseStudies = $caseStudies ?? [];
$availableTags = $availableTags ?? [];
$activeTag = $activeTag ?? '';
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
    <?php if ($availableTags): ?>
    <div class="mt-10 flex flex-wrap gap-3">
      <a href="/work" class="px-4 py-2 text-xs tracking-widest uppercase border transition <?php echo $activeTag === '' ? 'bg-accent text-black border-accent' : 'border-border text-text-secondary/70 hover:text-white hover:border-white'; ?>">All Work</a>
      <?php foreach ($availableTags as $tag): ?>
      <a href="/work?tag=<?php echo urlencode($tag); ?>" class="px-4 py-2 text-xs tracking-widest uppercase border transition <?php echo strcasecmp($activeTag, $tag) === 0 ? 'bg-accent text-black border-accent' : 'border-border text-text-secondary/70 hover:text-white hover:border-white'; ?>">
        <?php echo htmlspecialchars($tag); ?>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="border-b border-border">
  <div class="px-12 py-24">
    <?php if ($caseStudies): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
      <?php foreach ($caseStudies as $study): ?>
      <?php
      $studyTags = array_values(array_filter(array_map('trim', explode(',', (string) ($study['tags'] ?? '')))));
      $coverTags = array_slice($studyTags, 0, 2);
      $coverLabel = strtoupper(substr((string) ($study['client_name'] ?? $study['title']), 0, 2));
      ?>
      <article class="bg-mid border border-border hover:border-accent transition overflow-hidden">
        <div class="aspect-[4/3] relative overflow-hidden">
          <?php if (!empty($study['hero_image'])): ?>
          <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($study['hero_image']); ?>');"></div>
          <div class="absolute inset-0 bg-black/45"></div>
          <?php else: ?>
          <div class="absolute inset-0" style="background:
            radial-gradient(circle at 20% 20%, rgba(184, 255, 92, 0.22), transparent 32%),
            radial-gradient(circle at 78% 18%, rgba(255, 214, 94, 0.16), transparent 28%),
            linear-gradient(135deg, #0b3f39 0%, #14564d 42%, #1f2c27 100%);"></div>
          <div class="absolute inset-0 opacity-20" style="background-image:
            linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 28px 28px;"></div>
          <div class="absolute inset-y-0 right-0 w-1/2 opacity-10 flex items-center justify-center" style="font-family: 'lores-28', monospace; font-size: clamp(72px, 10vw, 160px); color: #FFFFFF;">
            <?php echo htmlspecialchars($coverLabel); ?>
          </div>
          <?php endif; ?>
          <div class="absolute inset-x-4 top-4 flex flex-wrap gap-2 pr-16">
            <?php foreach ($coverTags as $tag): ?>
            <a href="/work?tag=<?php echo urlencode($tag); ?>" class="relative z-10 px-3 py-1 text-[10px] tracking-widest uppercase border border-white/25 bg-black/35 text-white/90 hover:border-accent hover:text-accent transition">
              <?php echo htmlspecialchars($tag); ?>
            </a>
            <?php endforeach; ?>
          </div>
          <div class="absolute top-4 right-4 px-3 py-1 text-[10px] tracking-widest uppercase border border-white/20 bg-black/30 text-white/80">
            <?php echo htmlspecialchars((string) ($study['year'] ?? '')); ?>
          </div>
          <div class="absolute inset-x-0 bottom-0 p-5 bg-gradient-to-t from-black/80 to-transparent">
            <div class="text-sm text-text-secondary/80 mb-2"><?php echo htmlspecialchars($study['client_name'] ?? ''); ?></div>
            <div class="font-serif text-xl text-white"><?php echo htmlspecialchars($study['title']); ?></div>
          </div>
        </div>
        <div class="p-5">
          <p class="text-sm text-text-secondary/55 leading-relaxed mb-5"><?php echo htmlspecialchars(mb_substr(strip_tags(html_entity_decode($study['description'] ?? '', ENT_QUOTES, 'UTF-8')), 0, 110)); ?>...</p>
          <div class="flex flex-wrap gap-2 mb-5">
            <?php foreach (array_slice($studyTags, 0, 3) as $tag): ?>
            <a href="/work?tag=<?php echo urlencode($tag); ?>" class="px-3 py-1 text-[10px] tracking-widest uppercase border border-border text-text-secondary/70 hover:text-white hover:border-white transition">
              <?php echo htmlspecialchars($tag); ?>
            </a>
            <?php endforeach; ?>
          </div>
          <a href="/work/<?php echo htmlspecialchars($study['slug'] ?? ''); ?>" class="text-xs tracking-widest text-text-secondary/40 uppercase hover:text-accent transition">View Case Study ↗</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-mid px-8 py-16 text-center text-text-secondary">No case studies matched that filter. <a href="/work" class="text-accent hover:opacity-80 transition">Reset filters</a>.</div>
    <?php endif; ?>
  </div>
</section>
