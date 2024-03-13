up:
	@docker compose -f docker/docker-compose.yml --env-file ./.env up -d

down:
	@docker compose -f docker/docker-compose.yml --env-file ./.env down

ps:
	@docker compose -f docker/docker-compose.yml --env-file ./.env ps

migrate:
	@docker compose -f docker/docker-compose.yml --env-file ./.env exec php php yii migrate
