<?php
if (!isset($caseStudy) || !$caseStudy) {
    echo '<div class="px-12 py-24 text-center"><h1 class="text-2xl text-white">Case study not found</h1></div>';
    return;
}

$description = html_entity_decode($caseStudy['description'] ?? '', ENT_QUOTES, 'UTF-8');
$galleryImages = json_decode(html_entity_decode($caseStudy['gallery_images'] ?? '[]', ENT_QUOTES, 'UTF-8'), true);
$galleryImages = is_array($galleryImages) ? array_values(array_filter($galleryImages, 'is_string')) : [];
$tags = array_filter(array_map('trim', explode(',', (string) ($caseStudy['tags'] ?? ''))));
$services = array_filter(array_map('trim', explode(',', (string) ($caseStudy['services_provided'] ?? ''))));
?>

<div class="px-12 pt-20 pb-8 border-b border-border">
  <a href="/work" class="inline-flex items-center gap-2 text-xs tracking-widest text-text-secondary/35 hover:text-white uppercase transition">
    <span>←</span> Back to Work
  </a>
</div>

<section class="border-b border-border">
  <div class="relative overflow-hidden" style="min-height: 32rem;">
    <?php if (!empty($caseStudy['hero_image'])): ?>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($caseStudy['hero_image']); ?>');"></div>
    <?php else: ?>
    <div class="absolute inset-0" style="background:
      radial-gradient(circle at 18% 22%, rgba(184, 255, 92, 0.22), transparent 26%),
      radial-gradient(circle at 78% 18%, rgba(255, 214, 94, 0.14), transparent 24%),
      linear-gradient(135deg, #0b3f39 0%, #14564d 38%, #1f2c27 100%);"></div>
    <div class="absolute inset-0 opacity-20" style="background-image:
      linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
      background-size: 36px 36px;"></div>
    <div class="absolute inset-y-0 right-0 w-1/2 opacity-10 flex items-center justify-center" style="font-family: 'lores-28', monospace; font-size: clamp(120px, 18vw, 280px); color: #FFFFFF;">
      <?php echo htmlspecialchars(strtoupper(substr($caseStudy['client_name'] ?? $caseStudy['title'], 0, 2))); ?>
    </div>
    <?php endif; ?>
    <div class="absolute inset-0 bg-black/65"></div>

    <div class="relative z-10 px-12 py-24 flex items-end" style="min-height: 32rem;">
      <div class="max-w-4xl">
        <div class="text-xs tracking-widest text-accent uppercase mb-5"><?php echo htmlspecialchars($caseStudy['client_name'] ?? ''); ?> · <?php echo htmlspecialchars((string) ($caseStudy['year'] ?? '')); ?></div>
        <h1 class="leading-tight mb-6" style="font-family: 'lores-21-serif', monospace; font-weight: 400; font-size: clamp(32px, 4.5vw, 60px); color: #FFFFFF;"><?php echo htmlspecialchars($caseStudy['title']); ?></h1>
        <p class="text-base text-text-secondary max-w-2xl leading-relaxed"><?php echo htmlspecialchars(mb_substr(trim(strip_tags($description)), 0, 220)); ?></p>
      </div>
    </div>
  </div>
</section>

<section class="border-b border-border">
  <div class="px-12 py-24 grid grid-cols-1 md:grid-cols-2 gap-16">
    <div>
      <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-8">Overview</div>
      <div class="text-base text-text-secondary leading-relaxed whitespace-pre-line"><?php echo nl2br(htmlspecialchars($description)); ?></div>
    </div>

    <div class="space-y-10">
      <?php if ($tags): ?>
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-4">Tags</div>
        <div class="flex flex-wrap gap-3">
          <?php foreach ($tags as $tag): ?>
          <span class="px-3 py-2 text-xs tracking-widest uppercase border border-border text-text-secondary/65"><?php echo htmlspecialchars($tag); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($services): ?>
      <div>
        <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-4">Services</div>
        <div class="flex flex-wrap gap-3">
          <?php foreach ($services as $service): ?>
          <span class="px-3 py-2 text-xs tracking-widest uppercase border border-border text-text-secondary/65"><?php echo htmlspecialchars($service); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php if ($galleryImages): ?>
<section class="border-b border-border">
  <div class="px-12 py-24">
    <div class="text-xs tracking-widest text-text-secondary/50 uppercase mb-8">Gallery</div>
    <div class="space-y-6">
      <?php foreach ($galleryImages as $image): ?>
      <div class="bg-white p-6 md:p-10">
        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($caseStudy['title']); ?>" class="w-full h-auto block">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="border-b border-border relative overflow-hidden">
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none whitespace-nowrap" style="font-family: 'lores-28', monospace; font-weight: 400; font-size: clamp(100px, 18vw, 260px); color: rgba(255,255,255,0.04); user-select: none;">Launch</div>

  <div class="relative z-10 px-12 py-32 text-center">
    <div class="text-xs font-bold tracking-wider text-accent uppercase mb-6 flex justify-center items-center gap-2">
      <span class="inline-block w-2 h-2 bg-accent rounded-full animate-pulse"></span>
      Start Something Real
    </div>
    <h2 class="font-serif text-5xl md:text-6xl font-normal leading-tight max-w-3xl mx-auto mb-10">
      Need work that ships<br>and actually performs?
    </h2>
    <a href="/contact" class="bg-accent text-black px-8 py-3 font-bold text-xs tracking-widest uppercase hover:opacity-85 transition inline-flex items-center gap-2">
      Start a Project
    </a>
  </div>
</section>
