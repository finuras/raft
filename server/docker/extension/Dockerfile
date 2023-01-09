FROM serversideup/php:8.1-fpm-nginx

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#DOCKER-OUTSIDE-OF-DOCKER
RUN apt-get update
RUN apt-get install -y gnupg lsb-release sudo
RUN mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --batch --yes --dearmor -o /etc/apt/keyrings/docker.gpg
RUN echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
RUN apt-get update
RUN apt-get -y install docker-ce-cli docker-compose-plugin

# CLEANING LAYER
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

## USER
RUN echo 'webuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

COPY --chown=webuser:webgroup . /var/www/html

COPY --chmod=755 docker/extension/etc/s6-overlay/ /etc/s6-overlay/
