mv ./src/globals/Credentials.prod.php ./src/globals/Credentials.php
php phpunit.phar --log-junit php_test_report.xml ./tests