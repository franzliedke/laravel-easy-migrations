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

The second parameter is an array of column definitions, with the key being the column name.
The value of each item is an array with the column definitions, as understood by Laravel's `Illuminate\Database\Schema\Blueprint::addColumn()` method.
The first option is the column type, any other keyed option is passed through to `addColumn`.

The following options are supported for all column types:

- `nullable`: Whether the column allows `NULL` values, boolean, defaults to `false`
- `default`: Column default value, mixed
- `unique`: Creates a UNIQUE index for the column, boolean, defaults to `false`
- `first`: Insert the column as the first in the table, boolean, defaults to `false`, MySQL only
- `after`: Insert the column directly after the specified existing column, string, MySQL only

In the following, all supported types, along with custom options, are listed:

#### char, string

- `length`: Column size, integer

#### text, mediumText, longText

*No special options*

#### integer, tinyInteger, smallInteger, mediumInteger, bigInteger

- `autoIncrement`: Set to `true` to mark this column as sequence
- `unsigned`: Set to `true` to mark this column as unsigned integer

#### float, decimal

- `total`: Number of decimal digits, integer, defaults to `8`
- `places`: Number of digits after the decimal point, integer, defaults to `2`

#### double

- `total`: Number of decimal digits, integer
- `places`: Number of digits after the decimal point, integer

#### boolean

*No special options*

#### enum

- `allowed`: An array of possible values that the column can have

#### json, jsonb

*No special options*

#### date, dateTime, dateTimeTz, time, timeTz, timestamp, timestampTz

*No special options*

#### binary

*No special options*

#### uuid

*No special options*
