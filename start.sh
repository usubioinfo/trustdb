#!/bin/bash

# Start MySQL
service mysql start

# Wait for MySQL to start up
sleep 10

# Create the 'trustdb' database if it doesn't exist
mysql -e "CREATE DATABASE IF NOT EXISTS trustdb;"

# Create the MySQL user with specified permissions
mysql -e "CREATE USER IF NOT EXISTS 'rkataria'@'%' IDENTIFIED BY 'charlie0909';"
mysql -e "GRANT ALL PRIVILEGES ON trustdb.* TO 'rkataria'@'%';"
mysql -e "FLUSH PRIVILEGES;"

# Import the specific database dump into 'trustdb'
mysql -u rkataria -pcharlie0909 trustdb < /docker-entrypoint-initdb.d/trustdb_dump.sql

# Disable .htaccess by setting AllowOverride None in Apache configuration
# Note: Adjust the path if your Apache configuration is located differently
sed -i 's/AllowOverride All/AllowOverride None/g' /etc/apache2/apache2.conf

# Set the ServerName directive
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set permissions correctly
chown -R www-data:www-data /var/www/html/trustdb
chmod -R u+rwX,go=rX /var/www/html/trustdb

# Start Apache in the foreground
apache2ctl -D FOREGROUND