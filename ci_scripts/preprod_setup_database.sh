#!/bin/bash

mysql -u m2test7 -pm2test7 -h 172.20.128.68 < ./docker/preprod_qui_est_la.sql
mv ./src/globals/Credentials.preprod.php ./src/globals/Credentials.php