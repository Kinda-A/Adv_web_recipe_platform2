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
