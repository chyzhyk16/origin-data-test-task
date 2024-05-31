init-local: dc-up composer-install db-create migrate jwt-ssl-key-generate load-fixtures

dc-up:
	cd docker; docker-compose up -d

composer-install:
	docker exec -t origin-data-test-task_php-fpm sh -c "composer install"

db-create:
	docker exec -t origin-data-test-task_php-fpm sh -c "php bin/console doc:database:create --if-not-exists --no-interaction"

migrate:
	docker exec -t origin-data-test-task_php-fpm sh -c "php bin/console doctrine:migrations:migrate --no-interaction"

jwt-ssl-key-generate:
	docker exec -t origin-data-test-task_php-fpm sh -c "php bin/console lexik:jwt:generate-keypair --skip-if-exists"

load-fixtures:
	docker exec -t origin-data-test-task_php-fpm sh -c "php bin/console doctrine:fixtures:load --no-interaction"