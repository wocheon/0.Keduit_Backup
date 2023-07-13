#start install
#DB로 data전송
hostip=$(ip add show br01 | grep 192.168.1.* | gawk '{print $2}'| cut -c 1-13)
cpurate=$(mpstat | tail -1 | gawk '{print $13}' | gawk -F "." '{print 100-$1}')

vmname=$1
vcpus=$2
vram=$3

#insert into db
mysql testdb -u user1 -puser1 -e "insert into hosttbl values ('$HOSTNAME','$hostip',$cpurate)"
mysql testdb -u user1 -puser1 -e "insert into vmtbl values ('$HOSTNAME','$vmname',$vcpus,$vram)"
