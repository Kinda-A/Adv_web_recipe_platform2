# Docker + MySQL (local) - Quick start

1. Copy the Docker env template to `.env`:

```bash
cp .env.docker .env
```

2. Build and run (production-style):

```bash
docker compose -f docker-compose.yml up --build -d
```

3. For development (live code mounting):

```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up --build
```

4. Generate `APP_KEY` and run migrations:

```bash
docker compose exec app php artisan key:generate --show
docker compose exec app php artisan migrate --force
```

Notes:
- The `web` (nginx) service serves files at `http://localhost:8080`.
- For Render deployment, see `render.yaml` in the repo root.

Entrypoint behavior
- The image includes an `entrypoint.sh` that runs on container start. It will:
	- ensure storage permissions
	- run `composer install` if vendor is missing
	- generate `APP_KEY` if not provided
	- run migrations if `RUN_MIGRATIONS=true`
	- cache config/routes when `APP_ENV` is not `local`

Secrets to add on Render (recommended)
- `DB_PASSWORD` — strong password for the `mysql-db` private service.
- `MYSQL_ROOT_PASSWORD` — strong root password for the private MySQL service.
- `APP_KEY` — optional if you set `generateValue: true` in `render.yaml`; otherwise set a 32-char base64 key.
- `MAIL_USERNAME` and `MAIL_PASSWORD` — if you use SMTP.
- `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY` — if you use S3.

On Render set `RUN_MIGRATIONS=true` if you want migrations to run automatically at deploy time. Otherwise leave it `false` and run migrations manually via `docker compose exec app php artisan migrate --force` or Render console.

