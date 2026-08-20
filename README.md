# PredictiveCare Hub — Patient Record System

A PHP/MySQL patient record system with patient, doctor, and admin (IT / Health
Information Manager / Medical Record Manager) roles, document/prescription
requests, a predictive-analysis dashboard, and a Gemini-powered help chatbot.

Source lives in [`predictivecarehub.website/`](predictivecarehub.website), with
the web app under `predictivecarehub.website/public_html`.

## Routes

| Path | Purpose |
|---|---|
| `/login`, `/register` | Patient login / registration |
| `/admin` | Admin login (IT / HIM / MRM, by username) |
| `/doctor` | Doctor login (by username) |

Account credentials are **not** stored in this repo. Use your team's secrets
vault, or see "Local development" below for local-only seeded test accounts.

## Local development (Docker)

Requires Docker + Docker Compose.

```bash
cd predictivecarehub.website
cp .env.example .env        # fill in GEMINI_API_KEY if you want the chatbot working
docker compose up -d
```

This starts:
- **App** — http://localhost:8080
- **Mailpit** (catches every outgoing email — verification links, password
  resets, contact form) — http://localhost:8025
- **MySQL** — `localhost:3307` (see `.env` for credentials)

The database schema (`database/schema.sql`) is applied automatically on first
boot. It's a **reconstructed** schema — no dump existed anywhere in this repo,
so it was inferred from every query in the codebase. Diff it against your real
production schema before relying on it for anything beyond local dev.

### Seeding test accounts

The app never creates admin/doctor accounts by itself (there's no seed
script) — patients self-register, but staff accounts must be inserted
directly. Example, run from the host:

```bash
docker compose exec web php -r '
require "/var/www/html/public_html/config/index.php";
require "/var/www/html/public_html/vendor/autoload.php";
use Ramsey\Uuid\Uuid;

$id = Uuid::uuid4()->toString();
$hash = password_hash("YourLocalPassword1!", PASSWORD_DEFAULT);
$stmt = mysqli_prepare($conn, "INSERT INTO administrators (admin_id, firstname, lastname, username, password, user_type) VALUES (?,?,?,?,?,?)");
$fn="IT"; $ln="Staff"; $un="adminit"; $ut="it";
mysqli_stmt_bind_param($stmt, "ssssss", $id, $fn, $ln, $un, $hash, $ut);
mysqli_stmt_execute($stmt);
echo "created $un\n";
'
```

`user_type` is one of `it`, `him`, `mrm` for administrators. Doctors go in the
`doctors` table the same way, with a `department` column instead of a role.

### Stopping / resetting

```bash
docker compose down       # stop, keep the database
docker compose down -v    # stop and wipe the database (re-applies schema.sql fresh)
```

## Configuration (`.env`)

Copy `.env.example` to `.env` (gitignored — never commit real secrets here).

| Variable | Purpose |
|---|---|
| `APP_ENV` | `local` disables error display suppression |
| `APP_URL` | Used to build links in outgoing emails (verification, password reset) |
| `DB_HOST` / `DB_USER` / `DB_PASSWORD` / `DB_NAME` | Database connection |
| `MAIL_DSN` / `MAIL_FROM` | Symfony Mailer DSN — points at Mailpit locally |
| `GEMINI_API_KEY` | Get one at https://aistudio.google.com/apikey |
| `GEMINI_MODEL` | Defaults to `gemini-flash-lite-latest` |

## Security notes

- **The DB and SMTP passwords, and every account password, that were
  previously committed in plaintext to this repo's git history must be
  treated as compromised.** Rotate them on the real production system
  regardless of anything fixed in code — a code fix does not undo an
  already-exposed credential.
- CSRF protection, prepared statements, output escaping, session hardening,
  and per-action role checks were added in a security pass — see commit
  history for specifics before assuming any *new* endpoint is safe by
  default; follow the same patterns (`includes/security.php`) when adding one.
- The chatbot (`functions/chatbot.php`) is scoped to site-usage help only and
  is explicitly instructed not to give medical advice — review its system
  prompt before changing its behavior.

## Deploying to production

This repo has no deployment automation. At minimum, before pointing this at
real patients:
1. Rotate every credential mentioned above.
2. Set `APP_ENV=production` and a real `APP_URL`.
3. Serve over HTTPS and uncomment the HSTS header in `public_html/.htaccess`.
4. Compare `database/schema.sql` against your actual production database
   schema — it was reconstructed, not exported.
5. Run `composer install` in `public_html/` to pick up the `symfony/mailer`
   version bump (the committed `vendor/` still has the older version until
   you do).
