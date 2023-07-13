#libvert를 이용하여 이미지 설치 및 인스턴스  

virt-builder cirros-0.3.5 --size 5G -o /root/${1}.img

sudo virt-install --name ${1} --vcpus ${2} --ram ${3} --noautoconsole --graphics none  --disk path=/root/${1}.img --import

