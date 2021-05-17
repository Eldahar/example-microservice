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