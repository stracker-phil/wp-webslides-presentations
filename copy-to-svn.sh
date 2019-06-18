#!/bin/bash

DEVROOT=~/Local\ Sites/webslides/app/public/wp-content/plugins/webslides-presentations
SVNROOT=~/Local\ Sites/wordpressorg-plugins/app/public/wp-content/svn/webslides-presentations
STAGEROOT=~/Local\ Sites/wordpressorg-plugins/app/public/wp-content/plugins/webslides-presentations

echo ""
echo " * Dev: $DEVROOT"
echo " * SVN: $SVNROOT"
echo " * Stage: $STAGEROOT"
echo ""

(npm run --silent build > /dev/null)

echo " * Prepare plugin folders in Stage and SVN root..."
mkdir -p "${STAGEROOT}"
mkdir -p "${SVNROOT}"

# Prepare the SVN repo - remove old files.
rm -rf "${SVNROOT}/assets"
rm -rf "${SVNROOT}/trunk"
mkdir -p "${SVNROOT}/assets"

# Copy plugin files to the SVN repo.
echo " * Copy plugin from Dev folder to SVN folder..."
rsync -a "${DEVROOT}/" "${SVNROOT}/trunk" --exclude node_modules --exclude gulp --exclude wp-assets
rsync -a "${DEVROOT}/wp-assets/" "${SVNROOT}/assets"

# Remove dev files.
echo " * Remove dev files in SVN folder..."
rm -rf "${SVNROOT}/trunk/.git"

rm -f "${SVNROOT}/trunk"/*.config.js
rm -f "${SVNROOT}/trunk"/*.sh
rm -f "${SVNROOT}/trunk"/*.json
rm -f "${SVNROOT}/trunk"/*.md
rm -f "${SVNROOT}/trunk"/*.lock
rm -f "${SVNROOT}/trunk"/.DS_Store
rm -f "${SVNROOT}/trunk"/.gitignore
rm -f "${SVNROOT}/trunk"/.babelrc

# Finally copy the svn/trunk code to the plugins folder on stage
echo " * Copy actual plugin from SVN to Stage folder..."
rm -rf "${STAGEROOT}"
cp -R "${SVNROOT}/trunk" "${STAGEROOT}"
