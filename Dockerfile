FROM crazyyoshi/lemp5-alpine:latest
LABEL \
    Author='Miloud Maamar' \    
    Maintener='development@maamar.fr' \
    Licence='Mozilla Public License Version 2.0' \
    Version='1.0' \
    Description='An image containing some student projects carried out during my Master CEN training.' \
    Usage='docker run -d -p [WWW_HOST_PORT0]:80 -p [WWW_HOST_PORT1]:81 -p [WWW_HOST_PORT2]:82 -p [WWW_HOST_PORT3]:83 -p [WWW_HOST_PORT4]:84 -p [WWW_HOST_PORT5]:85'

RUN rm -f /etc/nginx/sites-enabled/*
COPY hosts /etc/nginx/sites-enabled
COPY dumps /usr/src/sqldump/
COPY projects /usr/share/nginx/html
EXPOSE 80 81 82 83 84 85