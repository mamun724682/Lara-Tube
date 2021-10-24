## Lara-Tube
Youtube clone using __Laravel 8 (PHP Framework)__ and __Vue js__ with support for __MySQL__ database

## Features

- Streamable Video processing for different bandwidth
- Storage and file systems
- Multiple video uploads with progress
- Nested commenting systems
- Subscription, Like-dislike system with reusable component

## Packages Used

- Laravel-ui
- Laravel ffmpeg
- Laravel medialibrary
- Toaster

## Installation Instruction

- Clone the repository with `git clone`
- Copy .env.example file to .env and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (It has some seeded data for your testing)
- That's it: launch the main URL and login with default credentials `john@doe.com` - `password`

## Contribution Guideline

- Fork the repository
- Clone the repository locally
- Create a new local branch
- Work on your local branch
- Push to remote
- When work is tested, done or ready, push to remote

## License

The Laravel Forum is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
