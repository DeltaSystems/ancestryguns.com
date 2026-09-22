FROM node:20

ARG TZ
ENV TZ="$TZ"

ARG CLAUDE_CODE_VERSION=latest

# Install basic development tools and iptables/ipset
RUN apt-get update && apt-get install -y --no-install-recommends \
  less \
  git \
  procps \
  sudo \
  fzf \
  zsh \
  man-db \
  unzip \
  gnupg2 \
  gh \
  iptables \
  ipset \
  iproute2 \
  dnsutils \
  aggregate \
  jq \
  nano \
  vim \
  apt-transport-https \
  ca-certificates \
  curl \
  wget \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP 8.4 CLI for Laravel Boost MCP (matches Lambda runtime).
# Debian bookworm ships PHP 8.2; we use Sury's repo for 8.4.
# No DB extensions installed — Boost DB tools are disabled for sandbox isolation.
RUN curl -sSLo /tmp/debsuryorg-archive-keyring.deb https://packages.sury.org/debsuryorg-archive-keyring.deb \
  && dpkg -i /tmp/debsuryorg-archive-keyring.deb \
  && rm /tmp/debsuryorg-archive-keyring.deb \
  && echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ bookworm main" \
    > /etc/apt/sources.list.d/php.list \
  && apt-get update && apt-get install -y --no-install-recommends \
    php8.4-cli \
    php8.4-mbstring \
    php8.4-xml \
    php8.4-curl \
    php8.4-zip \
    php8.4-bcmath \
    php8.4-gd \
  && apt-get clean && rm -rf /var/lib/apt/lists/* \
  && printf 'upload_max_filesize = 50M\npost_max_size = 50M\n' \
    > /etc/php/8.4/cli/conf.d/99-uploads.ini

# LibreOffice headless for docx/xlsx/pptx → PDF conversion.
# Used by the `example-template-ingestion` skill to ingest EHS inspection
# templates into `docs/ExampleTemplates/` as PDFs the report-generation agent
# consumes via Claude's document/File API. Dev-time tooling only; not on the
# Lambda runtime path.
RUN apt-get update && apt-get install -y --no-install-recommends \
    libreoffice-core \
    libreoffice-writer \
    libreoffice-calc \
    libreoffice-impress \
    fonts-liberation \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Ensure default node user has access to /usr/local/share
RUN mkdir -p /usr/local/share/npm-global && \
  chown -R node:node /usr/local/share

ARG USERNAME=node

# Persist bash history.
RUN SNIPPET="export PROMPT_COMMAND='history -a' && export HISTFILE=/commandhistory/.bash_history" \
  && mkdir /commandhistory \
  && touch /commandhistory/.bash_history \
  && chown -R $USERNAME /commandhistory

# Set `DEVCONTAINER` environment variable to help with orientation
ENV DEVCONTAINER=true

# Create workspace and config directories and set permissions
RUN mkdir -p /workspace /home/node/.claude && \
  chown -R node:node /workspace /home/node/.claude

WORKDIR /workspace

ARG GIT_DELTA_VERSION=0.18.2
RUN ARCH=$(dpkg --print-architecture) && \
  wget "https://github.com/dandavison/delta/releases/download/${GIT_DELTA_VERSION}/git-delta_${GIT_DELTA_VERSION}_${ARCH}.deb" && \
  sudo dpkg -i "git-delta_${GIT_DELTA_VERSION}_${ARCH}.deb" && \
  rm "git-delta_${GIT_DELTA_VERSION}_${ARCH}.deb"

# Set up non-root user
USER node

# Install global packages
ENV NPM_CONFIG_PREFIX=/usr/local/share/npm-global
ENV PATH=$PATH:/usr/local/share/npm-global/bin

# Set the default shell to zsh rather than sh
ENV SHELL=/bin/zsh

# Set the default editor and visual
ENV EDITOR=nano
ENV VISUAL=nano

# Default powerline10k theme
ARG ZSH_IN_DOCKER_VERSION=1.2.0
RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v${ZSH_IN_DOCKER_VERSION}/zsh-in-docker.sh)" -- \
  -p git \
  -p fzf \
  -a "source /usr/share/doc/fzf/examples/key-bindings.zsh" \
  -a "source /usr/share/doc/fzf/examples/completion.zsh" \
  -a "export PROMPT_COMMAND='history -a' && export HISTFILE=/commandhistory/.bash_history" \
  -x

# Install Claude
RUN npm install -g @anthropic-ai/claude-code@${CLAUDE_CODE_VERSION}

# Install uv/uvx (Python tool runner) for MCP servers distributed on PyPI
# (e.g. awslabs.aws-serverless-mcp-server). Installs into npm-global/bin
# which is already on PATH and writable by the node user.
RUN curl -LsSf https://astral.sh/uv/install.sh | \
    env UV_INSTALL_DIR=/usr/local/share/npm-global/bin INSTALLER_NO_MODIFY_PATH=1 sh


# Copy and set up firewall + secret-masking scripts.
# init-firewall.sh restricts outbound network; mask-secrets.sh bind-mounts
# /dev/null over src/.env so this container cannot read its contents
# (host file unaffected). verify-secret-isolation.sh fails container start
# if masking didn't take effect, so the breakage is loud, not silent.
COPY init-firewall.sh mask-secrets.sh verify-secret-isolation.sh /usr/local/bin/
USER root
RUN chmod +x /usr/local/bin/init-firewall.sh /usr/local/bin/mask-secrets.sh /usr/local/bin/verify-secret-isolation.sh && \
  printf 'node ALL=(root) NOPASSWD: /usr/local/bin/init-firewall.sh, /usr/local/bin/mask-secrets.sh\n' \
    > /etc/sudoers.d/node-devcontainer && \
  chmod 0440 /etc/sudoers.d/node-devcontainer && \
  rm -f /etc/sudoers.d/node-firewall
USER node