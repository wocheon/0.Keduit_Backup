#!/bin/bash
echo -e "\E[;34m <Start Install KVM instance> \E[0m"
sleep 1

echo " "
echo -e "\E[;32m what is vm name? \E[0m"
read -p "answer ? :" vmname1

echo " "

echo -e "\E[;32m what is vm's os? \E[0m"
echo "1.CentOS-7.8"
echo "2.ubuntu-18.04"
read -p "answer ? :" os1
echo " "

until [ $os1 = 1 ] || [ $os1 = 2 ]
do
echo -e "\E[;31m Wrong Answer! select 1or2 ! \E[0m"
read -p "answer ? : " os1
done

if [ $os1 = 1 ]; then
os1="centos"
vmos1="centos-7.8"
elif [ $os1 = 2 ]; then
os1="ubuntu-18.04"
vmos1="ubuntu-18.04"
fi

echo -e "\E[;32m what is flaver? \E[0m"
echo "1.Cpu1, RAM 1G, 10G disk"
echo "2.Cpu2, RAM 2G, 20G disk"
read -p "answer ? :" flav1
echo " "

until [ $flav1 = 1 ] || [ $flav1 = 2 ]
do
echo -e "\E[;31m Wrong Answer! select 1or2 ! \E[0m"
read -p "answer ? : " flav1
done

if [ $flav1 = 1 ]; then
flav1="cpu1, ram1 10gdisk"
vcpu1=1
vram1=1024
vdisk1=10
else
flav1="cpu2, ram2 20gdisk"
vcpu1=2
vram1=2048
vdisk1=20
fi

echo -e "\E[;32m what is root password? : \E[0m"
read -p "answer ? :" rootps1
echo " "


echo -e "\E[;32m what is vm's network? \E[0m"
echo "1.bridge"
echo "2.NAT(default)"
echo "3.isolated(testnet)"
read -p "answer ? :" net1
echo " "

until [ $net1 = 1 ] || [ $net1 = 2 ] 
do
echo -e "\E[;31m Only bridge setting is Available! \n please select again. \E[0m"
read -p "answer ? : " net1
done

if [ $net1 = 1 ]; then
net1="bridge"
bridge1='--network bridge=br02 --network bridge=br01'
else
echo " can't apply setting! apply default setting"
net1="default"
bridge1='--network network:default'
fi

echo -e "\E[;32m Can you access internet now? \E[0m"
echo "1.Yes(Use Virt-builder)"
echo "2.NO(Copy exist Image)"
read -p "answer ? :" method1
echo " "

until [ $method1 = 1 ] || [ $method1 = 2 ]
do
echo -e "\E[;31m Wrong Answer! select 1or2 ! \E[0m"
read -p "answer ? : " method1
done

if [ $method1 = 1 ]; then
inst1="Use Virt-Builder(Need internet access)"
else 
inst1='Copy exist Image'
fi

echo -e "\E[;32m check your choises! \E[0m"
echo "vm name : $vmname1"
echo "os : $os1"
echo "flaver : $flav1"
echo "password : $rootps1"
echo "net : $net1"
echo "method : $inst1"

echo -e "\E[;34m Countinue ? [y/yes/YES] \E[0m"
read conf1

case "$conf1" in
	y|yes|YES)
	echo "start install vm !"
	;;

	*)
	echo "stop install!"
	exit
esac


if [ $method1 = 1 ]; then
virt-builder ${vmos1} --format qcow2 --size ${vdisk1}G -o /vm/${vmos1}-${vmname1}.qcow2 --root-password password:${rootps1} --install httpd --install git-core --run /root/testrun.sh
virt-install --name ${vmname1} --vcpus ${vcpu1} --ram ${vram1} --graphics vnc ${bridge1} --disk path=/vm/${vmos1}-${vmname1}.qcow2 --import
else
cp "/vm/scriptimg/${vmos1}-${vcpu1}.qcow2" "/vm/${vmos1}-${vmname1}.qcow2"
virt-customize -a /vm/${vmos1}-${vmname1}.qcow2 --root-password password:$rootps1
virt-install --name ${vmname1} --vcpus ${vcpu1} --ram ${vram1} --graphics vnc ${bridge1} --disk path=/vm/${vmos1}-${vmname1}.qcow2 --import
fi

echo -e "\E[;34m VM install complete!  \E[0m"
