# Flysystem Local Symlink Plugin

## Requirements

+ [Flysystem](http://flysystem.thephpleague.com/) >= 1.0.0

## Installation

Using composer:

```
composer require falc/flysystem-local-symlink-plugin
```

Or add it manually:

```json
{
    "require": {
        "falc/flysystem-local-symlink-plugin": "1.*"
    }
}
```

## Usage

This plugin requires a `Filesystem` instance using the [Local adapter](http://flysystem.thephpleague.com/adapter/local/).

```php
use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;

$filesystem = new Filesystem(new LocalAdapter('/'));
```

### Symlink

Use `symlink($target, $symlink)` to create a symlink.

```php
$filesystem->addPlugin(new LocalSymlinkPlugin\Symlink());

$success = $filesystem->symlink('/tmp/some/target', '/tmp/symlink');
```

### DeleteSymlink

Use `deleteSymlink($symlink)` to delete a symlink.

```php
$filesystem->addPlugin(new LocalSymlinkPlugin\DeleteSymlink());

$success = $filesystem->deleteSymlink('/tmp/symlink');
```

### IsSymlink

Use `isSymlink($filename)` to check if a file exists and is a symlink.

```php
$filesystem->addPlugin(new LocalSymlinkPlugin\IsSymlink());

$isSymlink = $filesystem->isSymlink('/tmp/symlink');
```

### Full and relative paths

The above examples show how to create symlinks using `/` as root and full paths. But it is possible to use relative paths too.

```php
use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;

$filesystem = new Filesystem(new LocalAdapter('/home/falc'));
$filesystem->addPlugin(new LocalSymlinkPlugin\Symlink());
$filesystem->addPlugin(new LocalSymlinkPlugin\IsSymlink());
$filesystem->addPlugin(new LocalSymlinkPlugin\DeleteSymlink());

// Result: /home/falc/flytest -> /home/falc/projects/cli/flytest
$filesystem->symlink('projects/cli/flytest', 'flytest');

// It is possible to check it or delete it in the same way:
$isSymlink = $filesystem->isSymlink('flytest');
$filesystem->deleteSymlink('flytest');
```
