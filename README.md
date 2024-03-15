<h2>Prerequisites:</h2>

PHP >= <code>^8.2</code> <strong>(installed version 8.2.9)</strong>

Composer package manager (https://getcomposer.org/download/)

<h2>Installation:</h2>

<h4>Clone the repository:</h4>

<code>git clone git@github.com:AndrijaSlavkovic/q-agency.php-test.git</code>

<h4>Navigate to the project directory:</h4>


<code>cd q-api</code>

<h4>Install dependencies:</h4>

<code>composer install</code>

<h2>Configuration:</h2>
Related configs added for CLI command <code>app:create-author</code> are located inside <strong>config/q-api</strong>

<h2>Start development server:</h2>

<code>php artisan serve</code>

This will start a development server on your local machine, typically accessible at http://localhost:8000 (adjust the port if different).

<h2>Usage:</h2>

The application allows viewing authors, adding new books, associating them with authors from a dropdown menu, and creating new authors via CLI command listed above. Deleteing authors if no books are asociated with them, and deleting books from specific author.
