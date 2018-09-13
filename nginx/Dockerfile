FROM nginx

ADD ./default.conf /etc/nginx/conf.d/

ADD ./init.sh /root

ENV TZ=America/Chicago

RUN apt update && \
    apt install -y git curl wget gnupg tzdata && \
    curl -sL https://deb.nodesource.com/setup_8.x | bash - && \
    apt install -y nodejs && \
    chmod +x /root/init.sh && \
    echo "daemon off;" >> /etc/nginx/nginx.conf && \
    wget -q https://github.com/Yelp/dumb-init/releases/download/v1.2.1/dumb-init_1.2.1_amd64.deb && \
    dpkg -i dumb-init_*.deb && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

ENTRYPOINT ["dumb-init", "--"]
CMD ["/bin/bash", "/root/init.sh"]
