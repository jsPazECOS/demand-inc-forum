<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

Simple forum application that allows to view a list of posts, view the details of a single post, and create new posts and answers

Application built with Laravel, Vue JS and Inertia.

## Requirements
The requirements for this application are as follows:

1. Home Page:
- A list of all posts with the ability to search and sort by title.
- The output of posts should be done in pages of 10 items (with pagination).
- Any visitor can see the list of posts.
- Only an authorized visitor can create new posts.
- The search form should provide the ability to search the substring by partial occurrence in the title of the post.

2. Post Page:
- Detail view of a post.
- The output of responses should be done in pages of 3 items (with pagination).
- Any visitor can see the list of answers.
- Only an authorized visitor can create new answers.

## How to Run
1. Clone the repository to your local machine.
2. Change to application directory
3. Set up your database configuration in the `.env` file.
4. Run `docker-compose build` to build application services.
5. Run `docker-compose up -d` to start application services.
6. Run `docker exec -it demand-forum bash` to get into application container
7. Run `php artisan migrate --seed` to run the database migrations.
8. Visit `http://localhost:8000` in your browser to view the application.
9. Log in with these credential 
   - Email: test@laravel.com
   - Password: password
## Troubleshooting

### Troubleshooting: "/usr/bin/env: 'bash\r'" Error in Docker-Compose on Windows
#### Symptoms
- After running the command `docker-compose up -d`, you receive an error message "/usr/bin/env: 'bash\r'"
### Cause
- The error is caused by the use of Windows-style line endings (CR+LF) in the `docker-compose/start-container` script instead of Unix-style line endings (LF).
### Resolution
1. Open the command prompt or terminal window on your Windows machine.
2. Navigate to the directory where the `docker-compose/start-container` script is located.
3. Run the command `dos2unix docker-compose/start-container`.
4. This will convert the line endings in the script from Windows-style to Unix-style, which should resolve the issue.
5. Re-run the `docker-compose up -d` command to confirm that the error has been resolved.
