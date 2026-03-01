# Tailwind CSS - Quick Start

## 🚀 First Time Setup (30 seconds)

```bash
npm install
```

This installs Tailwind CSS locally.

---

## 📦 Build the CSS

```bash
npm run build
```

This generates `/public/css/tailwind.css` — the ONLY file you upload to SiteGround.

**Result:** Minified CSS file (~20-60 KB depending on classes used)

---

## 👨‍💻 Development Mode

```bash
npm run watch
```

Automatically rebuilds CSS as you edit files. Great for local development.

---

## 📋 Files to Upload to SiteGround

After running `npm run build`, upload everything except:
```
❌ node_modules/       (stays local only)
❌ src/                (stays local only)
❌ package.json        (reference only)
❌ tailwind.config.js  (reference only)
```

Just upload your normal `/public`, `/app`, `/views`, etc. and the fresh `tailwind.css` file.

---

## ✅ That's It!

- SiteGround will serve `tailwind.css` like any regular CSS file
- No Node.js needed on the server
- Pure CSS delivery = fast loading

Happy building! 🎨

---

### Commands Recap

| Task | Command |
|------|---------|
| Install Tailwind | `npm install` |
| Build for production | `npm run build` |
| Development with auto-rebuild | `npm run watch` |
| View built file | `cat public/css/tailwind.css` |

