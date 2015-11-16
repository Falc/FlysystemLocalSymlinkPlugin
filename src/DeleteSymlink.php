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
 * Local DeleteSymlink plugin.
 *
 * Implements a deleteSymlink($symlink) method for Filesystem instances using LocalAdapter.
 */
class DeleteSymlink implements PluginInterface
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
        return 'deleteSymlink';
    }

    /**
     * Method logic.
     *
     * Deletes a symlink.
     *
     * @see http://php.net/manual/en/function.unlink.php Documentation of unlink().
     *
     * @param   string  $symlink    Symlink name.
     * @return  boolean             True on success. False on failure.
     */
    public function handle($symlink)
    {
        $symlink = $this->filesystem->getAdapter()->applyPathPrefix($symlink);

        if (!is_link($symlink)) {
            return false;
        }

        return unlink($symlink);
    }
}
