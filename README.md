# expTrack
Expenses tracker application built with HTML, CSS, JS, and Bootstrap.
Hosted on an Apache2 server running PHP and MySQL.
Simple, lightweight, and practical.

## Hosting Requirements & Setup

- Web server: Apache2
- Backend: PHP (recommended version 7.4+)
- Database: MySQL (or MariaDB)
- Folder structure: Place all code inside your web root (e.g., `/var/www/html/expTrack`)
- Set up the database using provided SQL schema scripts (see `/app/db_schema.sql` if available)
- Configure database credentials in relevant include/config files (see `/include/config.php`)
- Make sure file/folder permissions allow Apache to read/execute application files

## Site Map

- **Home** — `index.html`  
  Main landing page.

- **Application** — `app/`  
  Contains main application pages and primary server-side files (e.g., dashboard, expense listing, add/edit expense).

- **Includes** — `include/`  
  PHP include files, helper functions, configuration, database access.

- **Assets**
  - **CSS** — `css/`
  - **JavaScript** — `js/`
  - **Bootstrap** — `bootstrap/`
  - **Fonts** — `webfonts/`
  - **Other static assets** — `assets/` (images, icons, logos, etc.)

- **Documentation** — `README.md`, any additional markdown or help files.

## Getting Started

1. Clone or download the repository.
2. Deploy it on your Apache server.
3. Configure database settings as necessary.
4. Navigate to the home page (`index.html`) via browser.
