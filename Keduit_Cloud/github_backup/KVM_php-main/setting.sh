#php 업그레이드
echo '<Install PHP (1/6)>'
yum install -y epel-release 
#echo '<Install PHP (2/6)>'
#yum install -y yum-utils-noarch 
echo '<Install PHP (2/6)>'
yum install -y yum-utils 
echo '<Install PHP (3/6)>'
yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm  
echo '<Install PHP (3/6)>'
yum install -y https://rpms.remirepo.net/enterprise/remi-release-7.rpm  
echo '<Install PHP (4/6)>'
yum install -y --enablerepo=remi-php72 install php  
echo '<Install PHP (5/6)>'
yum install -y --enablerepo=remi-php72 install php-mysql  
echo '<Install PHP (6/6)>'
yum install -y php72 php72-php-fpm php72-php-mysqlnd php72-php-opcache php72-php-xml php72-php-xmlrpc php72-php-gd php72-php-mbstring php72-php-json  
echo " complete!"

yum install -y mysql-client mysql vim sysstat net-tools 
systemctl enable httpd
systemctl restart httpd


#권한 수정
usermod -G wheel,qemu,root apache
chmod 777 /root/
chmod 777 /usr/share/httpd
chmod 777 /var/www/html
echo "apache          ALL=(ALL)       NOPASSWD: ALL">> /etc/sudoers
systemctl restart httpd




