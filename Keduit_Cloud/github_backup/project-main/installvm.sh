#변수 선언 부분(php를 통해 값을 받아오기위해 $1,$2등의 위치파라미터 사용)
name=$1
vcpus=$2
ram=$3
iprows=$(ip ad sh ens32 |grep 10.1.1 | wc -l)
newipnum=$(expr $iprows + 94 )


#virt-customize로 전달시킬 쉘스크립트생성 (샘플 파일을  복사하여 수정)
#qcow2 샘플이미지를 복사하여 설치 진행
#iprows를 통해 hostname을 설정함 (이후 컨테이너 배포과정에서 사용될 예정)
cp /root/aa/sample/sample_centos-7.8\$.qcow2 /root/aa/${name}.qcow2
cp /root/ipchange.sh /root/ipchange1.sh
sed -i "s/changeip/$4/g" /root/ipchange1.sh


#virt-customize, virt-install 진행하기
virt-customize -a /root/aa/${name}.qcow2 --upload /root/ipchange1.sh:/root/ --firstboot /root/ipchange1.sh --hostname worker$iprows

virt-install --name ${name} --vcpus ${vcpus} --ram ${ram} --noautoconsole  --network bridge=br01  --disk path=/root/aa/${name}.qcow2 --import


#ens32(10.1.1.x 대역)에 새로운 ip를 추가하는 과정
#현재 ip의 개수를 파악하고, 조건에 맞추어 새로운 ip를 추가함
#이 과정에서 사용된 iprows변수는 이후에 worker번호를 책정할때도 사용
echo "existed ip : $iprows"
echo "new ip :10.1.1.$newipnum"

echo "IPADDR${iprows}=10.1.1.$newipnum">>/etc/sysconfig/network-scripts/ifcfg-ens32
echo "done!"

grub2-mkconfig -o /boot/grub2/grub.cfg
systemctl restart network
ip ad sh ens32


#인스턴스에 masquerade설정이 제대로 먹히지않아서 추가한 명령어
systemctl restart firewalld



#docker node에 추가가 되었는지 확인한뒤, docker stack deploy를 통해 컨테이너 배포
#docker node에 추가될때까지 대기한 뒤에 배포를 진행하게된다
detect=$(docker node ls | grep worker$iprows | wc -l)

while [ $detect = 0 ]
do
sleep 2
echo ready
detect=$(docker node ls | grep worker$iprows | wc -l)
done
echo done



#랜덤포트를 뽑아내는 과정
#8000번부터 특정 숫자까지중 하나의 숫자를 뽑아내고 이 숫자가 DB에 추가되어있는지 확인(중복확인)
#만약 추가되어있다면 다시 숫자를 뽑게되고, DB에 존재하지않는다면 이를 포트번호로 사용함
a=$(echo $((RANDOM%19+8000)))
check=$(mysql aloedb -h 10.1.1.4 -uuser1 -puser1 -e "select * from testnum where num = $a" | grep $a | wc -l)

until [ $check = 0 ]
do
echo "number : $a"
echo "in db row :$check"
echo "====================="
echo " "
a=$(echo $((RANDOM%19+8000)))
check=$(mysql aloedb -h 10.1.1.4 -uuser1 -puser1 -e "select * from testnum where num = $a" | grep $a | wc -l)
done
echo $a
echo $a
echo "in db row :$check"



#선택된 포트번호를 DB에 저장하고 확인
mysql aloedb -h 10.1.1.4 -uuser1 -puser1 -e "insert into testnum values ($a)"
mysql aloedb -h 10.1.1.4 -uuser1 -puser1 -e "select * from testnum"



#sample yaml파일을 복사하여 수정하기
#yaml파일에서 constranit는 node.hostname으로 설정되어있음
#이전과정에서 얻은 hostname과 포트번호를 입력하여 docker deploy를 실행
cp aa/sample/start2.yml /root/wp${iprows}.yml
sed -i "s/worker/worker${iprows}/g" /root/wp${iprows}.yml
sed -i "s/9999/$a/g" /root/wp${iprows}.yml
docker stack deploy -c /root/wp${iprows}.yml wp-worker${iprows}



#iptables를 이용한 포트포워딩
#파일에 iptables 포트포워딩 명령어를 저장한뒤 불러와서 실행되는 형태
echo "iptables -t nat -A PREROUTING -p tcp -i ens32 -d 10.1.1.${newipnum} --dport 80 -j DNAT --to ${4}:$a">>/root/aa/sample/portforward.sh

source /root/aa/sample/portforward.sh
