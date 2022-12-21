# Cto Backpack Operations

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![The Whole Fruit Manifesto](https://img.shields.io/badge/writing%20standard-the%20whole%20fruit-brightgreen)](https://github.com/the-whole-fruit/manifesto)

This package provides Backpack Operations functionality for projects that use the [Backpack for Laravel](https://backpackforlaravel.com/) administration panel. 

## Screenshots

![Screenshot](https://user-images.githubusercontent.com/569999/208795348-a1cbe182-7191-4ed5-a27b-aa61945f9165.png)
![screencapture-127-0-0-1-8000-admin-article-setting-2022-12-21-09_55_03](https://user-images.githubusercontent.com/569999/208795344-6deadc19-d9dd-430d-9a83-60f190387e86.png)

## Installation

Via Composer

``` bash
composer require tjslash/cto-backpack-operations
```

## Usage

```php
class ArticleCrudController extends CrudController
{
    use \Tjslash\CtoBackpackOperations\Http\Controllers\Operations\SettingOperation;
    ...
    
    /**
     * Setup setting operation
     * 
     * @return void
     */
    protected function setupSettingOperation() : void
    {
        CRUD::addField([ 
            'name' => 'articles-limit',
            'label' => 'Articles limit',
        ]);
    }
    ...
}
```

## Change log

Changes are documented here on Github. Please see the [Releases tab](https://github.com/tjslash/cto-backpack-operations/releases).

## Testing

``` bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for a todolist and howtos.

## Security

If you discover any security related issues, please email vakylenkox@gmail.com instead of using the issue tracker.

## Credits

- [Artem Vakylenko][link-author]
- [All Contributors][link-contributors]

## License

This project was released under MIT, so you can install it on top of any Backpack & Laravel project. Please see the [license file](license.md) for more information. 

However, please note that you do need Backpack installed, so you need to also abide by its [YUMMY License](https://github.com/Laravel-Backpack/CRUD/blob/master/LICENSE.md). That means in production you'll need a Backpack license code. You can get a free one for non-commercial use (or a paid one for commercial use) on [backpackforlaravel.com](https://backpackforlaravel.com).


[ico-version]: https://img.shields.io/packagist/v/tjslash/cto-backpack-operations.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tjslash/cto-backpack-operations.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tjslash/cto-backpack-operations
[link-downloads]: https://packagist.org/packages/tjslash/cto-backpack-operations
[link-author]: https://github.com/tjslash
[link-contributors]: ../../contributors
