#!/bin/sh
# npm install --legacy-peer-deps && chown -R node /app/node_modules && npm run build
cp -r /app/dist /app_dist_host
exec "$@"
