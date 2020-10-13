echo "DROP DATABASE IF EXISTS preprod_qui_est_la;" | mysql -u m2test7 -pm2test7 -h 172.20.128.68
echo "CREATE DATABASE IF NOT EXISTS preprod_qui_est_la DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;" | mysql -u m2test7 -pm2test7 -h 172.20.128.68
mysql -u m2test7 -pm2test7 -h 172.20.128.68 preprod_qui_est_la < ./docker/preprod_qui_est_la.sql