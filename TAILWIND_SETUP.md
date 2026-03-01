# Tailwind CSS Setup for 26 Labs

This project now uses **Tailwind CSS** for styling. Here's how to build and deploy it.

## Setup (First Time Only)

### Step 1: Install Dependencies
```bash
npm install
```

This installs Tailwind CSS and creates `node_modules/`.

### Step 2: Build CSS
```bash
npm run build
```

This creates `/public/css/tailwind.css` (the only file you upload to SiteGround).

**Note:** `node_modules/` is NOT uploaded — only the compiled `tailwind.css` file.

---

## Development (While Editing)

Watch for changes and rebuild automatically:
```bash
npm run watch
```

Then edit your PHP/HTML files and Tailwind classes update in real-time.

---

## Files You Actually Upload to SiteGround

After building, upload **only these**:
```
/public/
  ├── index.php
  ├── .htaccess
  ├── css/
  │   ├── tailwind.css      ← Fresh build from npm run build
  │   ├── admin.css
  │   └── style.css
  ├── js/
  ├── images/
/app/
/views/
/config/
/database/
/storage/
/installer/
.env.example
composer.json
```

**Do NOT upload:**
- `node_modules/` (stays local only)
- `src/` (stays local only)
- `package.json` (reference only, not needed on server)
- `tailwind.config.js` (reference only, not needed on server)

---

## How It Works

1. **Locally:** You run `npm run watch`
   - Tailwind watches your PHP/HTML files
   - Automatically builds `tailwind.css` when you add new classes

2. **On SiteGround:** 
   - Plain PHP server serves `tailwind.css` like any CSS file
   - No Node.js, no npm, no build process needed
   - Just load the file in your `<head>`

---

## Building Before Each Deploy

Before uploading to SiteGround:
```bash
npm run build
```

This minifies the CSS and removes unused classes (reduces file size 50-80%).

---

## Adding Classes While Building

The `tailwind.config.js` file tells Tailwind where to find your classes:
```javascript
content: [
  "./public/**/*.php",      // All PHP files
  "./views/**/*.php"        // All view files
]
```

Add new Tailwind classes anywhere in these files, and they'll be compiled automatically.

---

## Example Usage in PHP

```html
<!-- Hero section with Tailwind -->
<section class="py-3xl bg-black text-white">
  <h1 class="text-hero font-serif leading-tight">
    Elevate Your Brand
  </h1>
  <p class="text-lg text-text-secondary mt-lg">
    Premium creative direction for ambitious brands
  </p>
  <button class="btn-primary mt-2xl">Start Your Project</button>
</section>
```

---

## Color Reference

Colors defined in `tailwind.config.js`:

| Class | Color | Usage |
|-------|-------|-------|
| `bg-primary` | #2d5016 | Primary green |
| `bg-accent` | #d4a574 | Accent gold |
| `bg-black` | #1a1a1a | Dark backgrounds |
| `bg-white` | #f9f9f9 | Light backgrounds |
| `bg-light` | #f9f9f9 | Light sections |
| `border` | #e5e5e5 | Borders |
| `text-primary` | #2d5016 | Primary text |
| `text-accent` | #d4a574 | Accent text |

Use any with `text-`, `bg-`, `border-`, etc.

---

## Spacing Reference

| Class | Size |
|-------|------|
| `p-xs`, `m-xs` | 4px |
| `p-sm`, `m-sm` | 8px |
| `p-md`, `m-md` | 16px |
| `p-lg`, `m-lg` | 24px |
| `p-xl`, `m-xl` | 32px |
| `p-2xl`, `m-2xl` | 48px |
| `p-3xl`, `m-3xl` | 64px |

---

## Responsive Classes

Use breakpoints with `:` syntax:
```html
<!-- Responsive text size -->
<h1 class="text-2xl md:text-3xl lg:text-4xl">Title</h1>

<!-- Hide on mobile, show on desktop -->
<div class="hidden md:block">Desktop only</div>

<!-- Different padding on mobile vs desktop -->
<div class="px-md md:px-lg">Content</div>
```

Breakpoints:
- `sm:` - tablets (640px+)
- `md:` - medium screens (768px+)
- `lg:` - large screens (1024px+)
- `xl:` - extra large (1280px+)

---

## Troubleshooting

### "tailwind.css not found"
Make sure you ran `npm run build` first:
```bash
npm run build
```

### Classes not being applied
1. Restart the watch: `npm run watch`
2. Hard-refresh browser: `Ctrl+Shift+R`
3. Check filename in `content:` array in `tailwind.config.js`

### File size too large
Run production build:
```bash
npm run build
```

This minifies and purges unused classes.

### Want to use custom CSS too?
Keep your `style.css` and `admin.css` files. Tailwind works alongside them:
```html
<link rel="stylesheet" href="/css/tailwind.css">
<link rel="stylesheet" href="/css/style.css">
```

---

## Quick Commands Reference

```bash
# First time setup
npm install
npm run build

# During development
npm run watch      # Auto-rebuild on file changes

# Before deployment
npm run build      # Final production build (minified)

# View generated CSS
cat public/css/tailwind.css
```

---

## Next Steps

1. Run `npm install` and `npm run build`
2. Link `<link rel="stylesheet" href="/css/tailwind.css">` in your PHP files
3. Start using Tailwind classes in your HTML
4. Run `npm run watch` for live development
5. Run `npm run build` before pushing to SiteGround

---

**You're all set!** Start building with Tailwind. 🚀
