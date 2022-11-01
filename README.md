CONTENTS OF THIS FILE
---------------------

* Introduction
* Requirements
* Installation
* Configuration
* Troubleshooting
* FAQ
* Maintainers

INTRODUCTION
------------

REQUIREMENTS
------------

This module requires the following library:

* [swiper.js](https://github.com/nolimits4web/swiper) library

INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. Visit [Installing Modules](https://www.drupal.org/node/1897420) for further information.


* Install the swiper.js javascript library.

### Simple installation

* Download the library from the [zip link](https://github.com/nolimits4web/swiper/archive/refs/heads/master.zip)
* Unzip the files from the archive and place it in Drupal's library folder. For example `/web/libraries/swiper`

### Composer (recommended)

If you would like to install the swiper library with composer, you probably used the [drupal composer template](https://github.com/drupal-composer/drupal-project) to set up your project. It's recommended to use [asset-packagist](https://asset-packagist.org) to install JavaScript libraries.

- Add the Composer Installers Extender PHP package by oomphinc to your project's root `composer.json` file, by running the following command:

```
composer require oomphinc/composer-installers-extender
```

- Add Asset Packagist to the `"repositories"` section of your project's root `composer.json`.

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
],
```

- It's also needed to extend the `"installer-path"` section:

```json
"web/libraries/{$name}": [
    "type:drupal-library",
    "type:bower-asset",
    "type:npm-asset"
],
```
- And add a new `"installer-types"` section next to the `"installer-path"` in the `"extra"` section:

```json
"installer-types": ["bower-asset", "npm-asset"],
```

After this you can install the library with `composer require npm-asset/swiper` and the library will be downloaded into the library's folder.

### Composer (merge plugin)

- Install the [Composer  Merge Plugin](https://github.com/wikimedia/composer-merge-plugin):

```
composer require wikimedia/composer-merge-plugin
```

- Edit the `composer.json` file of your website and under the `"extra": {` section add:

```json
"merge-plugin": {
    "include": [
        "web/modules/contrib/swipers/composer.libraries.json"
    ]
},
```

Note: the `web` represents the folder where drupal lives, eg. `docroot`. From now on, every time the `composer.json` file is updated, it will also read the content of `composer.libraries.json` file located at `web/modules/contrib/swipers/` and update accordingly.
Install required libraries:

```
composer update
```
