<?php
// This view expects the following variables:
// - title: Page title
// - caseStudies: Array of case studies
// - posts: Array of blog posts
// - services: Array of services
// - stats: Array of stats
// - csrf_token: CSRF token
// - csrf_field: CSRF field name
?>

<!-- Hero Section -->
<section id="hero" class="hero">
    <div class="hero-content">
        <h1>Elevate Your Brand</h1>
        <p class="hero-subtitle">Premium creative direction for ambitious brands</p>
        <button class="btn-primary" data-scroll-to="inquiry">Start Your Project</button>
    </div>
    <div class="hero-image">
        <div class="placeholder-image"></div>
    </div>
</section>

<!-- Project Inquiry Form -->
<section id="inquiry" class="inquiry-section">
    <div class="container">
        <h2>Tell Us About Your Project</h2>
        <form id="inquiryForm" class="inquiry-form">
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
            
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" id="company" name="company">
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="services">Services Interested In</label>
                <div class="checkboxes">
                    <label><input type="checkbox" name="services[]" value="Brand Strategy"> Brand Strategy</label>
                    <label><input type="checkbox" name="services[]" value="Visual Identity"> Visual Identity</label>
                    <label><input type="checkbox" name="services[]" value="Web Design"> Web Design</label>
                    <label><input type="checkbox" name="services[]" value="Creative Direction"> Creative Direction</label>
                </div>
            </div>

            <div class="form-group">
                <label for="budget">Budget Range</label>
                <select id="budget" name="budget">
                    <option value="">Select budget range</option>
                    <option value="5k-10k">$5,000 - $10,000</option>
                    <option value="10k-25k">$10,000 - $25,000</option>
                    <option value="25k-50k">$25,000 - $50,000</option>
                    <option value="50k+">$50,000+</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn-primary btn-wide">Submit Inquiry</button>
            <div id="formMessage" class="form-feedback"></div>
        </form>
    </div>
</section>

<!-- Stats Row -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $stat): ?>
            <div class="stat-item">
                <div class="stat-value"><?php echo htmlspecialchars($stat['value']); ?></div>
                <div class="stat-label"><?php echo htmlspecialchars($stat['label']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about">
    <div class="container">
        <h2>About 26 Labs</h2>
        <p>We're a premium creative agency founded on the belief that great design transforms brands. Our multidisciplinary team brings together strategy, design, and technology to create unforgettable experiences.</p>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container">
        <h2>Our Services</h2>
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card">
                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <?php if ($service['bullets']): ?>
                <ul>
                    <?php foreach (explode("\n", $service['bullets']) as $bullet): ?>
                        <?php if (trim($bullet)): ?>
                        <li><?php echo htmlspecialchars(trim($bullet)); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Case Studies Section -->
<section id="cases" class="case-studies">
    <div class="container">
        <h2>Featured Work</h2>
        <div class="case-grid">
            <?php foreach ($caseStudies as $case): ?>
            <div class="case-card">
                <?php if ($case['hero_image']): ?>
                <div class="case-image">
                    <img src="<?php echo htmlspecialchars($case['hero_image']); ?>" alt="<?php echo htmlspecialchars($case['title']); ?>">
                </div>
                <?php endif; ?>
                <div class="case-content">
                    <h3><?php echo htmlspecialchars($case['title']); ?></h3>
                    <p class="case-client"><?php echo htmlspecialchars($case['client_name']); ?></p>
                    <p><?php echo htmlspecialchars($case['description']); ?></p>
                    <?php if ($case['tags']): ?>
                    <div class="case-tags">
                        <?php foreach (explode(',', $case['tags']) as $tag): ?>
                            <span class="tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Blog/Insights Section -->
<section id="insights" class="insights">
    <div class="container">
        <h2>Latest Insights</h2>
        <div class="posts-grid">
            <?php foreach ($posts as $post): ?>
            <article class="post-card">
                <?php if ($post['featured_image']): ?>
                <div class="post-image">
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                </div>
                <?php endif; ?>
                <div class="post-content">
                    <time class="post-date"><?php echo date('M d, Y', strtotime($post['publish_date'])); ?></time>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($post['content'], 0, 150)) . '...'; ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.getElementById('inquiryForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const messageDiv = document.getElementById('formMessage');
    
    try {
        const response = await fetch('/inquiry', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
            messageDiv.className = 'form-feedback success';
            messageDiv.textContent = data.message;
            e.target.reset();
        } else {
            messageDiv.className = 'form-feedback error';
            messageDiv.textContent = data.error || 'An error occurred';
        }
    } catch (error) {
        messageDiv.className = 'form-feedback error';
        messageDiv.textContent = 'Failed to submit form';
    }
});

document.querySelectorAll('[data-scroll-to]').forEach(el => {
    el.addEventListener('click', (e) => {
        const target = document.getElementById(e.target.dataset.scrollTo);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>
