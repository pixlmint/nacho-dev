<?php

namespace App\Controller\DEV;

use FilesystemIterator;
use Nacho\Controllers\AbstractController;
use Nacho\Models\HttpResponse;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * A Controller for modifying the current framework installation,
 * useful for automated testing
 */
class ConfigurationController extends AbstractController
{
    /**
     * Sets up a completely fresh installation by deleting
     * the data, media, backups and content directories
     *
     * - **ROUTE:** `/api/dev/fresh-install`
     *
     * @return HttpResponse
     */
    public function freshInstall(): HttpResponse
    {
        $dirs = ['content', 'backups', 'media', 'data', 'var'];
        $errorDir = null;
        foreach ($dirs as $dir) {
            if ($dir) {
                $success = self::rmdirRecursive($dir);
                if (!$success) {
                    $errorDir = $dir;
                    break;
                }
            }
        }

        if ($errorDir) {
            return $this->json(["message" => "error deleting directory $errorDir"], 500);
        }

        return $this->json(["message" => sprintf("successfully deleted %s", implode(", ", $dirs))]);
    }

    public function enableDebug(): HttpResponse
    {
    }

    private function setDebugMode(bool $debugEnabled): bool
    {
        $configFile = "config/config.json";
        $config = json_decode(file_get_contents($configFile), true);

        if (!key_exists("base", $config)) {
            $config["base"] = [];
        }

        $config["base"]["debugEnabled"] = TRUE;

        file_put_contents($configFile, )
    }

    private static function rmdirRecursive(string $directoryPath): bool
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directoryPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        return rmdir($directoryPath);
    }
}