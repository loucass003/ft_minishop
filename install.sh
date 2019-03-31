# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    install.sh                                         :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: llelievr <llelievr@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/03/31 15:20:55 by llelievr          #+#    #+#              #
#    Updated: 2019/03/31 16:38:41 by llelievr         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

apt-get update
apt-get install -y apache2
apt-get install -y php7.0 php7.0-mysql php7.0-zip php7.0-mbstring php7.0-json
apt-get install -y mysql-server
mysql < /git/configs/default-user.sql
apt-get install -y curl vim htop unzip
if ! [ -L /var/www ]; then
	rm -rf /var/www
	ln -fs /git/src /var/www
fi
rm -r /etc/apache2/sites-available
mkdir /etc/apache2/sites-available
cp /git/configs/apache-config.conf /etc/apache2/sites-available/
cat /git/configs/envs >> /etc/apache2/envvars
a2enmod rewrite
a2ensite apache-config.conf
a2dissite 000-default.conf
service apache2 restart
