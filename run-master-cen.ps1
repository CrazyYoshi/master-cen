docker stop $(docker ps -aq)
docker rm $(docker ps -aq)
docker build $(Get-Location)/. -t master-cen:latest
docker run -d -p 80:80 -p 81:81 -p 82:82 -p 83:83 -p 84:84 -p 85:85 master-cen:latest