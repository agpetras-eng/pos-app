# FEU POS (IT0049 TFA3)

A small point-of-sale system built with CodeIgniter 4.

**Features**
- Dashboard home screen with big buttons, live clock and overview
- Customers: list, add (`/customers/new`), edit
- User accounts: list, add (`/users/new`), edit
- Form validation with error messages; the form keeps what you typed
- Avatar upload on the user edit page (JPG or PNG, max 2MB), 150x150 thumbnail, only the file name is saved in the database
- Placeholder image when a user has no avatar

**Live site:** https://YOUR-SITE.infinityfreeapp.com

## Run it on your computer

1. Install XAMPP (PHP 8.2 or higher), Composer and Git.
2. In `C:\xampp\php\php.ini`, remove the `;` before `extension=intl`. Start MySQL in XAMPP.
3. Get the code, then in the project folder run:
   ```
   composer install
   ```
4. Copy the file `env` to `.env` and set these lines (remove the `#`):
   ```
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = pos_db
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```
5. In phpMyAdmin, create a database named `pos_db`, open it, and import `database/pos_db.sql`.
6. Run:
   ```
   php spark serve
   ```
   then open http://localhost:8080

## Color palette
- FEU Green `#006400` (and bright green `#009900`)
- FEU Gold `#FFC20E` (and bright gold `#FFD700`)
- White `#FFFFFF`

## Folder guide
- `app/Controllers`: Home, Customers, Users
- `app/Models`: CustomerModel, UserModel
- `app/Views`: layout, dashboard, customers, users
- `public/css/pos.css`: all styles
- `public/uploads`: uploaded avatars (`avatars` = original, `thumbs` = thumbnail)
- `database/pos_db.sql`: database export

## Hosting on InfinityFree (summary)
1. Create the account, then a MySQL database in the control panel. Import `database/pos_db.sql` with its phpMyAdmin.
2. Build a deploy folder: put `app`, `vendor` (installed with `composer install --no-dev`), `writable` and `.env` inside a folder called `ci_app`. Copy `app/.htaccess` into `ci_app/.htaccess`.
3. Put the contents of `public` (`index.php`, `.htaccess`, `css`, `images`, `uploads`) next to `ci_app`.
4. In that `index.php`, change `require FCPATH . '../app/Config/Paths.php';` to `require FCPATH . 'ci_app/app/Config/Paths.php';`
5. In `ci_app/.env` set `CI_ENVIRONMENT = production`, your site `app.baseURL`, and the InfinityFree database host, name, username and password.
6. Upload everything into the `htdocs` folder with FileZilla.
