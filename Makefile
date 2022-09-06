.PHONY: lint
lint:
	bin/console lint:container
	bin/console lint:yaml config/services.yaml --parse-tags
	vendor/bin/php-cs-fixer fix -v --dry-run --stop-on-violation
	vendor/bin/phpstan analyse --memory-limit=1G