init:
	docker compose up -d --build
	docker compose exec app composer install

start:
	docker compose up -d --build