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
 * Local Symlink plugin.
 *
 * Implements a symlink($symlink, $target) method for Filesystem instances using LocalAdapter.
 */
class Symlink implements PluginInterface
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
        return 'symlink';
    }

    /**
     * Method logic.
     *
     * Creates a symlink.
     *
     * @see http://php.net/manual/en/function.symlink.php Documentation of symlink().
     *
     * @param   string  $target     Symlink target.
     * @param   string  $symlink    Symlink name.
     * @return  boolean             True on success. False on failure.
     */
    public function handle($target, $symlink)
    {
        $target = $this->filesystem->getAdapter()->applyPathPrefix($target);
        $symlink = $this->filesystem->getAdapter()->applyPathPrefix($symlink);

        return symlink($target, $symlink);
    }
}
