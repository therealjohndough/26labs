#!/bin/bash
# deploy.sh — push to GitHub and deploy to SiteGround production
# Usage: ./deploy.sh
# Usage: ./deploy.sh "optional commit message"

set -e

MSG="${1:-deploy: update}"

echo "→ Staging all changes..."
git add -A

if git diff --cached --quiet; then
  echo "  Nothing to commit — pushing existing HEAD"
else
  git commit -m "$MSG"
fi

echo "→ Pushing to GitHub (origin)..."
git push origin main

echo "→ Deploying to SiteGround (production)..."
git push production main

echo "✓ Done"
