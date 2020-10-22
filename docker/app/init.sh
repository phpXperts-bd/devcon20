#!/bin/bash

# Update nginx to match worker_processes to no. of cpu's
procs=$(cat /proc/cpuinfo |grep processor | wc -l)
sed -i -e "s/worker_processes  1/worker_processes $procs/" /etc/nginx/conf.d/default.conf

# Always chown webroot for better mounting 
ls /var/www/app| xargs chown -Rf nginx:nginx

# install crontab
env>>/etc/environment
crontab /etc/cron.d/devcon20-cron

# Start supervisord and services
/usr/local/bin/supervisord -n -c /etc/supervisord.conf