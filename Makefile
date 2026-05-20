init:
#	mkdir -p var/cache/smarty
#	chmod -R 777 var/cache
	cp .env.example .env
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app php bin/seed.php

start:
	docker compose up -d --build