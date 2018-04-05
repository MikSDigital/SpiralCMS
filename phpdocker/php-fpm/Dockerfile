FROM phpdockerio/php72-fpm:latest
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.2-mysql \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Node & NPM
RUN apt-get update \
    && apt-get -y install nano

# Install Node & NPM
RUN apt-get update \
    && apt-get -y install nodejs \
    && apt-get -y install npm

# Update node version
RUN npm cache clean -f \
    && npm install -g n \
    && n stable

RUN ln -s /usr/bin/nodejs /usr/bin/node

# Install webpack
RUN npm install @symfony/webpack-encore --save-dev