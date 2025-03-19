# Image

Lightweight class that assists with versioning static asset files. Designed to be integrated with a CI/CD pipeline.

## Usage

### Setting version

Ideally this is the part that would be integrated into a CI/CD pipeline.

```php
use cjrasmussen\StaticFileVersioning\FileVersion;

$fileVersion = new FileVersion('/path/to/config/file.json');

$fileVersion->set('styles.css', '-v1234');
$fileVersion->save();
```

### Getting version

Likely used in building a view for a web interface.

```php
use cjrasmussen\StaticFileVersioning\FileVersion;

$fileVersion = new FileVersion('/path/to/config/file.json');

echo 'styles' . $fileVersion->get('styles.css') . '.css';
// output: styles-v1234.css
```

## Installation

Simply add a dependency on cjrasmussen/static-file-versioning to your composer.json file if you use [Composer](https://getcomposer.org/) to manage the dependencies of your project:

```sh
composer require cjrasmussen/static-file-versioning
```

Although it's recommended to use Composer, you can actually include the file(s) any way you want.


## License

StaticFileVersioning is [MIT](http://opensource.org/licenses/MIT) licensed.