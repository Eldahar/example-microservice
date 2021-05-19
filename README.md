Microservices:
- employee
- timeregister
- SAGA
- statement (kimutatás)


Hogyan keszult:

mkdir microservices/
cd microservices/
composer create-project symfony/skeleton:^5.2.7 --ignore-platform-reqs employee
composer require symfony/debug-bundle --dev
composer require php-amqplib/rabbitmq-bundle
composer require symfony/serializer-pack

Futtatasa:
make terminal-employee
composer install
./bin/console employee:create Kovacs Sandor 165

make terminal-saga
composer install
./bin/console rabbitmq:consumer hrbase_employee

make terminal-reporting
composer install
./bin/console rabbitmq:consumer reporting_employee

make terminal-reporting
composer install
./bin/console rabbitmq:consumer daily_workhour_calculation


make terminal-registration
composer install
./bin/console registration:create 123 165 1 "2021-05-11 08:00:12"
./bin/console registration:create 123 165 2 "2021-05-11 17:10:08"

make terminal-saga
./bin/console rabbitmq:consumer workhour_registration

make terminal-reporting
./bin/console rabbitmq:consumer reporting_registration

make terminal-reporting
./bin/console rabbitmq:consumer daily_workhour_calculation