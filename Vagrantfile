VAGRANTFILE_API_VERSION = "2"

$master_script = <<SCRIPT

# Fix Time
apt-get update
apt-get -y install ntpdate
ntpdate pool.ntp.org

# Set Hostname
echo "master-dev" > /etc/hostname
hostname -F /etc/hostname

# Install Sublime Text and dependencies
cd /tmp
export DEBIAN_FRONTEND=noninteractive
apt-get -y install libglib2.0-0 libgtk2.0-0 tidy
wget http://c758482.r82.cf2.rackcdn.com/sublime-text_build-3059_amd64.deb
dpkg -i sublime-text_build-3059_amd64.deb

# Install Database
mysql -uroot -p'vagrant' -e "DROP DATABASE IF EXISTS AuthCentral"
mysqladmin -u root -p'vagrant' create AuthCentral
mysql -u root -p'vagrant' AuthCentral < /vagrant/extra/database.sql

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
cd /vagrant
composer install

# Identify Environment
touch /vagrant/VagrantDev.txt
date > /etc/vagrant_provisioned_at
SCRIPT

$slave_script = <<SCRIPT

# Fix Time
apt-get update
apt-get -y install ntpdate
ntpdate pool.ntp.org

# Set Hostname
echo "slave" > /etc/hostname
hostname -F /etc/hostname

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
cd /vagrant
composer install

# Identify Environment
touch /vagrant/VagrantDev.txt
date > /etc/vagrant_provisioned_at
SCRIPT


Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

   config.vm.define "master" do |master|
     master.vm.box =  "debian-7.5.0_puppet"
     master.vm.box_url = "http://mirror.netbydesign.biz/vagrant/debian-7.5.0_puppet.box"
     master.vm.box_download_checksum = "5fb438988ddb6ce864f010fc902d4d020f4324cd"
     master.vm.box_download_checksum_type = "sha1"
     master.vm.network "private_network", ip: "192.168.50.2"

     master.vm.network "forwarded_port", guest: 80, host: 8080

     master.vm.provision "shell", inline: $master_script
   end

   config.vm.define "slave" do |slave|
     slave.vm.box =  "debian-7.5.0_puppet"
     slave.vm.box_url = "http://mirror.netbydesign.biz/vagrant/debian-7.5.0_puppet.box"
     slave.vm.box_download_checksum = "5fb438988ddb6ce864f010fc902d4d020f4324cd"
     slave.vm.box_download_checksum_type = "sha1"
     slave.vm.network "private_network", ip: "192.168.50.3"

     slave.vm.network "forwarded_port", guest: 80, host: 8081

     slave.vm.provision "shell", inline: $slave_script
   end

   config.vm.define "proxy" do |proxy|0
     proxy.vm.box =  "debian-7.5.0_puppet"
     proxy.vm.box_url = "http://mirror.netbydesign.biz/vagrant/debian-7.5.0_puppet.box"
     proxy.vm.box_download_checksum = "5fb438988ddb6ce864f010fc902d4d020f4324cd"
     proxy.vm.box_download_checksum_type = "sha1"
     proxy.vm.network "private_network", ip: "192.168.50.4"

     proxy.vm.network "forwarded_port", guest: 80, host: 8082

     proxy.vm.provision "shell", inline: $slave_script
   end

end
