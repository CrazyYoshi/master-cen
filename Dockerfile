FROM crazyyoshi/lemp5-alpine:latest
COPY nginx.conf /etc/nginx/nginx.conf
COPY metrosecours.sql microblog.sql newdawn.sql /usr/src/sqldump/
COPY projects /usr/share/nginx/html
EXPOSE 80 81 82 83 84 85