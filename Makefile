HOSTS_ENTRY:=127.0.0.1 local.notifier.app

.PHONY: install
install: docker-build dev

.PHONY: host-entry
host-entry:
	(grep "$(HOSTS_ENTRY)" /etc/hosts) || echo '$(HOSTS_ENTRY)' | sudo tee -a /etc/hosts

.PHONY: docker-build
docker-build:
	docker-compose build --no-cache

.PHONY: test-unit
test-unit:
	docker-compose exec php-fpm ./vendor/bin/phpunit tests	

.PHONY: dev
dev: host-entry
	docker-compose up -d --no-build --remove-orphans --force-recreate
	docker-compose exec php-fpm composer install
	@echo "######################################################"
	@echo ""
	@echo "Done, now open http://local.notifier.app:8181 for backend service"
	@echo ""
	@echo "######################################################"
