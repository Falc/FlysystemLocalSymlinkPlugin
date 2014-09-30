# Flysystem Local Symlink Plugin

## Requirements

+ [Flysystem](http://flysystem.thephpleague.com/) >= 0.5.0

## Installation

Using composer:

```json
{
    "require": {
        "falc/flysystem-local-symlink-plugin": "dev-master"
    }
}
```

## Usage

This plugin requires a `Filesystem` instance using the [Local adapter](http://flysystem.thephpleague.com/adapter/local/).

```php
<?php

use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;

$filesystem = new Filesystem(new LocalAdapter('/'));
```

### Symlink

Use `symlink($symlink, $target)` to create a symlink.

```php
$filesystem->addPlugin(new LocalSymlinkPlugin\Symlink());

$success = $filesystem->symlink('/tmp/symlink', '/tmp/some/target');
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
