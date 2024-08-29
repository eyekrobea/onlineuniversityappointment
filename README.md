## Online Uni

### Requirements
- ![PHP](https://img.shields.io/badge/PHP-8.2.0-blue)
- ![Composer](https://img.shields.io/badge/Composer-2.1.9-blue)
- ![XAMPP](https://img.shields.io/badge/XAMPP-3.3.0-blue)

### Download
- [Composer](https://getcomposer.org/download/)
- [XAMPP](https://www.apachefriends.org/download.html)


### Installation
Run the following commands in your terminal:
```sh
cd /path/to/htdocs/project
```

1. Clone the repository
```sh
git clone $REPO_URL
```

2. Install Composer packages
```sh
composer install
```

3. Create a new database and import the `database.sql` file

4. Rename the `.env.example` file to `.env` and update the database credentials
5. Start the server
```sh
php -S localhost:8000
```
6. Visit `http://localhost:8000` in your browser
7. Login with the following credentials:
- Lecturer: `id: 12345, password: password`
- Student: `id: 123456, password: password`
- Admin: `id: 1234567, password: password`
