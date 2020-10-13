mv ./src/globals/Credentials.preprod.php ./src/globals/Credentials.php
php phpunit.phar --log-junit php_test_report.xml ./tests