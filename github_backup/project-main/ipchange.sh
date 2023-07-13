#ip 변경 작업
echo -e "TYPE=Ethernet\nNAME=eth0\nONBOOT=yes\nBOOTPROTO=none\nIPADDR=changeip\nPREFIX=24\nGATEWAY=192.168.1.11\nDNS1=8.8.8.8">/etc/sysconfig/network-scripts/ifcfg-eth0

systemctl restart network

#패키지 설치,selinux등의 설정
#초기 이미지 설정에 주로 사용되고 이후 설치시에는 필요한것만 사용함

#yum install -y httpd; systemctl enable httpd; systemctl restart httpd
systemctl stop firewalld; setenforce 0

#yum install -y yum-utils device-mapper-persistent-data lvm2
#yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
#yum install -y docker-ce
#systemctl enable docker
systemctl start docker


#docker 클러스터 join을 위한 명령어
#kvm1,2마다 다르게 설정되어있고, KVM이 매니저로 있는 클러스터에join됨

docker swarm join --token SWMTKN-1-0jhuythazxchfnfpwijz0tbwi5k71rc43kj55x289744xuq9xb-9w2odrzq32qt20a4gv6i0dhcf 192.168.1.11:2377
