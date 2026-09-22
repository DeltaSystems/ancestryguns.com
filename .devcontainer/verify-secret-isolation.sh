#!/usr/bin/env bash
# Verifies that secret files masked via /dev/null bind mounts in
# devcontainer.json are actually empty inside the container.
#
# Why: bind-mounting /dev/null over a file is the standard technique to
# hide secrets from a sandbox, but it can silently fail (e.g. mount
# ordering, Docker Desktop quirks). If it fails, the host's real .env is
# visible inside the container with no warning. This guard fails the
# container start so the breakage is loud, not silent.

set -euo pipefail

protected=(
  /workspace/src/.env
)

failed=0
for path in "${protected[@]}"; do
  if [ ! -e "$path" ]; then
    echo "ok: $path is missing"
    continue
  fi
  if [ -n "$(cat "$path" 2>/dev/null || true)" ]; then
    echo "FATAL: $path has readable content -- /dev/null bind mount is not active." >&2
    echo "       Fully rebuild the container (Command Palette: 'Dev Containers: Rebuild Container')." >&2
    failed=1
  else
    echo "ok: $path is blank"
  fi
done

exit "$failed"
