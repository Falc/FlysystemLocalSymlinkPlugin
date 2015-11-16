<?php
/**
 * This file is part of FlysystemLocalSymlinkPlugin.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2014 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Flysystem\Plugin\Symlink\Local;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

/**
 * Local IsSymlink plugin.
 *
 * Implements a isSymlink($filename) method for Filesystem instances using LocalAdapter.
 */
class IsSymlink implements PluginInterface
{
    /**
     * FilesystemInterface instance.
     *
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * Sets the Filesystem instance.
     *
     * @param FilesystemInterface $filesystem
     */
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Gets the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'isSymlink';
    }

    /**
     * Method logic.
     *
     * Tells whether the specified $filename exists and is a symlink.
     *
     * @see http://php.net/manual/en/function.is-link.php Documentation of is_link().
     *
     * @param   string  $filename   Filename.
     * @return  boolean             True if $filename is a symlink. Else false.
     */
    public function handle($filename)
    {
        $filename = $this->filesystem->getAdapter()->applyPathPrefix($filename);

        return is_link($filename);
    }
}
