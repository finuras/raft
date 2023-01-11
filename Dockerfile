FROM scratch

LABEL org.opencontainers.image.title="Sidecar" \
    org.opencontainers.image.description="An assistant that helps with the development of web applications. It includes a feature for setting up a proxy (have multiple web apps running at same time, with a local TLD), as well as support for Secure Sockets Layer (SSL)." \
    org.opencontainers.image.vendor="Finuras" \
    com.docker.desktop.extension.api.version=">= 0.3.0" \
    com.docker.desktop.extension.icon="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png" \
    com.docker.extension.screenshots='[{"alt":"hello world light mode", "url":"https://docker-extension-screenshots.s3.amazonaws.com/minimal-frontend/hello-world-light.png"}, {"alt":"hello world dark mode", "url":"https://docker-extension-screenshots.s3.amazonaws.com/minimal-frontend/hello-world-dark.png"}]' \
    com.docker.extension.detailed-description="<h1>Description</h1><p>This is a sample extension that displays the content of an <code>index.html</code> page inside Docker Desktop.</p>" \
    com.docker.extension.publisher-url="https://github.com/finuras" \
    com.docker.extension.additional-urls='[{"title":"SDK Documentation","url":"https://docs.docker.com/desktop/extensions-sdk"}]' \
    com.docker.extension.changelog="<ul><li>Added metadata to provide more information about the extension.</li></ul>"

COPY ui ./ui
COPY metadata.json .
COPY vm/docker-compose.yaml .
