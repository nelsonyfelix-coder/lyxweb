# Felix Nelsony Portfolio

A Laravel 13 portfolio for Felix Nelsony / Lyxweb Technologies, with an editable admin workspace and an SSH-based VPS release workflow.

## What is included

- Responsive portfolio pages for projects, services, skills, profile details, and enquiries.
- Project detail pages with search metadata, filters for Web App, Mobile App, SaaS, and Enterprise App, plus optimized preview artwork.
- Admin workspace at `/admin` for projects, preview image uploads, services, skills, profile settings, and contact messages.
- A floating WhatsApp contact button using the profile WhatsApp URL or phone number.
- Project categories are Web App, Mobile App, SaaS, and Enterprise App.
- Contact form validation, a honeypot, and request throttling. Messages are saved in the database.
- No frontend CDN dependencies. CSS and the small navigation/filter script are built with Vite.
- GitHub Actions builds the app on pushes to `main` and can deploy versioned releases to a VPS over SSH.

## Requirements

- PHP 8.4.1 or newer with the extensions required by this dependency lock.
- Composer 2.
- Node.js 20.19+ or 22.12+ and npm.
- SQLite for a local setup, or MySQL/MariaDB on the VPS.

## Run locally

```sh
composer install
cp .env.example .env
php artisan key:generate
```

Create an empty SQLite database at `database/database.sqlite` if it is not already present, then set `DB_CONNECTION=sqlite` in `.env`:

```powershell
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite | Out-Null }
```

Build the frontend, create the schema, and add the portfolio starter content:

```sh
npm ci
npm run build
php artisan migrate --seed
```

Create the administrator account. The command asks for a name and a password of at least 12 characters; no default admin password is shipped:

```sh
php artisan portfolio:make-admin
```

Start the local server:

```sh
php artisan serve
```

Open `/` for the public portfolio and `/admin` for the content workspace.

## Configure the VPS

Use a Linux VPS with Nginx, PHP 8.4.1+ FPM, Composer 2, Node.js 20.19+ or 22.12+, Git, rsync, and MySQL/MariaDB. Create the database and a limited database user before the first deployment.

Choose an application path such as `/var/www/lyxweb-portfolio`, then prepare shared state outside versioned releases:

```sh
sudo mkdir -p /var/www/lyxweb-portfolio/shared/storage/{app/public,framework/cache/data,framework/sessions,framework/views,logs}
sudo chown -R deploy:www-data /var/www/lyxweb-portfolio
```

As the deploy user, create `/var/www/lyxweb-portfolio/shared/.env` with production values. At minimum configure:

```dotenv
APP_NAME="Felix Nelsony Portfolio"
APP_ENV=production
APP_KEY=base64:GENERATE_A_REAL_KEY_BEFORE_FIRST_DEPLOY
APP_DEBUG=false
APP_URL=https://lyxweb.co.tz

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Generate a key once before the first deployment (do not rotate it on each release):

```sh
php -r 'echo "base64:".base64_encode(random_bytes(32)).PHP_EOL;'
```

Set ownership and permissions so the deploy user can update releases and PHP-FPM can write to shared storage. Keep `APP_DEBUG=false` in production.

Configure Nginx to use `/var/www/lyxweb-portfolio/current/public` as its document root. The server must route requests through `public/index.php`; never point the web root at the repository root. A starter config is in [`deploy/nginx.conf`](deploy/nginx.conf). Update its PHP-FPM socket if your VPS uses a different supported PHP version. Enable TLS for `lyxweb.co.tz` before switching live traffic.

### First deployment

The GitHub workflow creates a release, links its `.env` and `storage` to the shared paths, runs migrations, caches Laravel's production files, and atomically switches `current` to the new release.

After the first release is available, run these once on the VPS:

```sh
cd /var/www/lyxweb-portfolio/current
php artisan db:seed --class=PortfolioSeeder --force
php artisan portfolio:make-admin
```

Run those seed/admin commands only for initial setup. The starter seeder updates the default portfolio records, so rerunning it later would overwrite edits made in the dashboard.

Upload project screenshots from **Admin → Projects → Edit project**. Public uploads are stored under the shared `storage/app/public/projects` directory and served through the `/storage` link. The preloaded SVG previews are lightweight placeholders; replace them with your own project screenshots as you add real work.

### GitHub Actions secrets

Add these repository secrets under **Settings → Secrets and variables → Actions**:

| Secret | Value |
| --- | --- |
| `VPS_HOST` | VPS IP address or hostname |
| `VPS_PORT` | SSH port, usually `22` |
| `VPS_USER` | Dedicated deployment account |
| `VPS_SSH_KEY` | Private key for that account |
| `VPS_KNOWN_HOSTS` | The VPS SSH host key line, verified out of band |
| `VPS_APP_PATH` | Absolute release root, e.g. `/var/www/lyxweb-portfolio` |

The deployment job is intentionally disabled on the first push. After the VPS, database, shared `.env`, and SSH secrets are ready, add the repository Actions variable `ENABLE_VPS_DEPLOY` with the value `true` to turn on deploys from `main`.

Keep the SSH key in GitHub Secrets and add only its public half to the VPS deployment account. The workflow checks out the code, installs production dependencies, builds assets, and runs PHP syntax checks. A successful push to `main` then uploads a versioned release and runs the deploy commands over SSH. The existing `current` symlink and older releases are retained for rollback.

## Portfolio content

Starter profile, projects, services, and skills come from the supplied portfolio reference and the current public site. Edit or remove any draft details from `/admin`; projects can be published, featured, categorized, and linked to live/source URLs. Contact form messages are kept in the database and can be read or deleted from the admin inbox.

## Deployment notes

- Point the domain's DNS to the VPS and set up Nginx/TLS before enabling the production workflow.
- Confirm the VPS has PHP 8.4.1+ FPM and the required extensions before the first deploy.
- Back up the database and `shared/.env` independently of GitHub. Neither is included in deployment artifacts.
- The workflow keeps previous release directories so the `current` symlink can be pointed back to a prior release if a deployment needs to be rolled back.

