#!/usr/bin/env bash
# Bind-mounts /dev/null over secret files so this container cannot read
# their contents. The host file is unaffected — only this container's
# view is replaced. Reads return 0 bytes; writes are silently discarded.
#
# Why a runtime mount instead of a `mounts` entry in devcontainer.json:
# the JetBrains "Build new and mount sources" path silently drops bind
# mounts whose source path doesn't exist on the host (e.g. /dev/null on
# Windows). Doing it inside the container sidesteps that.
#
# Idempotent: safe to re-run on container restart. Uses /proc/self/mountinfo
# rather than `mountpoint -q` since the latter is unreliable for files.

set -euo pipefail

protected=(
  /workspace/src/.env
)

for path in "${protected[@]}"; do
  if [ ! -e "$path" ]; then
    echo "mask-secrets: $path missing, nothing to mask"
    continue
  fi

  if grep -qE " ${path} " /proc/self/mountinfo; then
    echo "mask-secrets: $path already masked"
    continue
  fi

  mount --bind /dev/null "$path"
  echo "mask-secrets: bound /dev/null over $path"
done
