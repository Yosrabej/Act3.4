<?php

namespace AppBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends Controller
{
    /**
     * @Route("/create/{filename}", name="create_file")
     */
    public function createfile($filename)
    {
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // create a new file
        try {
            $new_file_path = $current_dir_path .  "/" . $filename;

            if (!$fsObject->exists($new_file_path)) {
                $fsObject->touch($new_file_path);
                $fsObject->chmod($new_file_path, 0777);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new Response('<html><h1>created</h1></html>');
    }

    /**
     * @Route("/write/{filename}/{text}", name="write_file")
     */
    public function writefile($filename, $text)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // addcontents
        try {
            $file_path = $current_dir_path . "/" . $filename;

            if ($fsObject->exists($file_path)) {
                $fsObject->chmod($file_path, 0777);
                $fsObject->appendToFile($file_path, $text);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new Response('<html><h1>write</h1></html>');
    }
    /*
    public function appendToFile($filename, $content)
    {
        $dir = dirname($filename);

        if (!is_dir($dir)) {
            $this->mkdir($dir);
        } elseif (!is_writable($dir)) {
            throw new IOException(sprintf('Unable to write to the "%s" directory.', $dir), 0, null, $dir);
        }

        if (false === @file_put_contents($filename, $content, FILE_APPEND)) {
            throw new IOException(sprintf('Failed to write file "%s".', $filename), 0, null, $filename);
        }
        return new Response('<html><h1>write</h1></html>');
    }*/

    /**
     * @Route("/delete/{filename}", name="delete_file")
     */
    public function deletefile($filename)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // addcontents
        try {
            $file_path = $current_dir_path . "/" . $filename;

            if ($fsObject->exists($file_path)) {
                $fsObject->chmod($file_path, 0777);
                // $filename = iterator_to_array($filename, false);
                $fsObject->remove([$filename]);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new Response('<html><h1>deleted</h1></html>');
    }

    /**
     * @Route("/copy/{from}/{to}", name="copy_file")
     */
    public function copyfile($from, $to)
    {
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        //copy a file
        try {
            $originfile = $current_dir_path . "/" . $from;
            $targetfile = $current_dir_path . "/" . $to;

            if ($fsObject->exists($originfile)) {
                $fsObject->copy($originfile, $targetfile);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error copying directory at" . $exception->getPath();
        }
        return new Response('<html><h1>copied</h1></html>');
    }
}
