# laravel-easy-migrations

**Simple, reversible migrations for Laravel.**

This package makes it easy to create automatically reversible database migrations for common operations.
This way, you don't have to deal with the time-consuming and error-prone (not to mention stupid and boring) task of manually writing the `down` logic for your migrations.

## Installation

Run `composer require franzl/laravel-easy-migrations` and you're good to go.

## Usage

To create a reversible migration, extend your migration class from the `Franzl\EasyMigrations\EasyMigration` base class.
Your task: Overwrite the `change` method, which needs to return another migration instance.
Luckily, this package already provides implementations for the most common migration operations.

For example, to add a new `users` table:

~~~php
use Franzl\EasyMigrations\Easy;
use Franzl\EasyMigrations\EasyMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends EasyMigration
{
    public function change()
    {
        return Easy::createTable('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }
}
~~~

Based on the parameters passed to `Easy::createTable()`, this method will return a migration instance with the `up` and `down` methods already implemented for you.

## Documentation

This package currently implements the following four operations:

- Creating tables
- Renaming tables
- Renaming columns
- Adding columns

More will likely be implemented soon.
Feel free to suggest a new operation type by creating an issue.

### Creating tables

~~~php
public function change()
{
    return Easy::createTable('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
    });
}
~~~

### Renaming tables

~~~php
public function change()
{
    return Easy::renameTable('old_users', 'new_users');
}
~~~

### Renaming columns

~~~php
public function change()
{
    return Easy::renameColumn('users', 'name', 'username');
}
~~~

### Adding columns

~~~php
public function change()
{
    return Easy::addColumns('users', [
        'password' => ['string'],
        'registered_at' => ['dateTime', 'nullable' => true]
    ]);
}
~~~
