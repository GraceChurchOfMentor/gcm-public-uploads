#!/bin/bash

# Joomla updates break the file and directory permissions,
# causing grunt to error out. This is annoying and breaks
# the site. Use this script to quickly repair permissions.
#
# This script will apply the following changes to the site directory:
#
# 1. Change user & group ownership to the webserver user & group.
# 2. Find all user-writeable files and also make them group-writeable.
# 3. Set the SGID permission on all directories.

httpd_user="www-data"
httpd_group="www-data"
site_path="./"

if [ "$EUID" -ne 0 ]; then
    echo "Please run this script as root."
    exit 1
fi

chown -R $httpd_user:$httpd_group "$site_path"

find "$site_path" -perm -u+w -exec chmod g+w {} \;
find "$site_path" -type d -exec chmod g+s {} \;
