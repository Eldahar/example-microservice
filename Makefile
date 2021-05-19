MAINDIR=$(shell pwd)

terminal-employee:
	docker exec -it example-microservice_employee_1 /bin/bash

terminal-saga:
	docker exec -it example-microservice_saga_1 /bin/bash

terminal-registration:
	docker exec -it example-microservice_registration_1 /bin/bash

terminal-reporting:
	docker exec -it example-microservice_reporting_1 /bin/bash

terminal-mysql:
	docker exec -it example-microservice_mysql_1 /bin/bash


#saga-queue-hrbase_employee:
#	docker exec -it example-microservice_saga_1 ./bin/console rabbitmq:consumer hrbase_employee
#
#saga-queue-workhour_registration:
#	docker exec -it example-microservice_saga_1 ./bin/console rabbitmq:consumer workhour_registration

reporting-queue-reporting_employee:
	docker exec -it example-microservice_reporting_1 ./bin/console rabbitmq:consumer reporting_employee

reporting-queue-daily_workhour_calculation:
	docker exec -it example-microservice_reporting_1 ./bin/console rabbitmq:consumer daily_workhour_calculation

init:
	docker exec -it example-microservice_employee_1 composer install
	docker exec -it example-microservice_saga_1 composer install
	docker exec -it example-microservice_registration_1 composer install
	docker exec -it example-microservice_reporting_1 composer install

init-database: init
	docker exec -it example-microservice_employee_1 ./bin/console doctrine:database:create
	docker exec -it example-microservice_employee_1 ./bin/console doctrine:schema:create
	docker exec -it example-microservice_registration_1 ./bin/console doctrine:database:create
	docker exec -it example-microservice_registration_1 ./bin/console doctrine:schema:create
	docker exec -it example-microservice_reporting_1 ./bin/console doctrine:database:create
	docker exec -it example-microservice_reporting_1 ./bin/console doctrine:schema:create

remove-database:
	docker exec -it example-microservice_employee_1 ./bin/console --force doctrine:database:drop
	docker exec -it example-microservice_registration_1 ./bin/console --force doctrine:database:drop
	docker exec -it example-microservice_reporting_1 ./bin/console --force doctrine:database:drop

watch-queues:
	docker exec -it example-microservice_rabbitmq_1 watch -n1 rabbitmqctl list_queues -p microservices

build:
	cd ${MAINDIR}/docker/microservice-api && docker build -t eldahar/microservice-api .
	docker push eldahar/microservice-api:latest
	cd ${MAINDIR}/docker/microservice-cli && docker build -t eldahar/microservice-cli .
	docker push eldahar/microservice-cli:latest