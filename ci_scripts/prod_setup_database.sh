echo "DROP DATABASE IF EXISTS prod_qui_est_la;" | mysql -u m2test7 -pm2test7 -h 172.20.128.68
echo "CREATE DATABASE IF NOT EXISTS prod_qui_est_la DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;" | mysql -u m2test7 -pm2test7 -h 172.20.128.68
mysql -u m2test7 -pm2test7 -h 172.20.128.68 prod_qui_est_la < ./docker/preprod_qui_est_la.sql