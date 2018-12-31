FROM node:8.15-alpine

RUN apk update && apk upgrade && \
    apk --no-cache add \
        autoconf \
        nasm \
        automake \
        make \
        g++ \
        gcc \
        libtool \
        libpng-dev

WORKDIR /usr/src/app

COPY src/package*.json ./

RUN npm install

ENTRYPOINT ["npm"]