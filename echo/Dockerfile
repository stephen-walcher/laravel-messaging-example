FROM node:8-slim

ENV DOCKERIZE_VERSION v0.6.1

RUN apt update && \
    apt install -y sqlite wget openssl && \
    yarn global add laravel-echo-server --prefix /usr/local

COPY laravel-echo-server.json /app/laravel-echo-server.json

WORKDIR /app

RUN mkdir -p ./build && \
    mkdir -p ./node_modules && \
    mkdir -p /home/node/.cache/yarn && \
    chown node:node -R ./ /home/node && \
    yarn && \
    wget -q https://github.com/Yelp/dumb-init/releases/download/v1.2.1/dumb-init_1.2.1_amd64.deb && \
    dpkg -i dumb-init_*.deb && \
    yarn cache clean

EXPOSE 6001

USER node

ENTRYPOINT ["dumb-init", "--"]
CMD ["/usr/local/bin/laravel-echo-server", "start"]
