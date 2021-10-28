<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;

class FileSystemImproved
{

    public function __construct()
    {
        //$this->em = $entityManager;
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // create a new folder
        try {
            $new_dir_path = $current_dir_path . "/fsi";

            if (!$fsObject->exists($new_dir_path)) {
                $fsObject->mkdir($new_dir_path, 0775);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating directory at" . $exception->getPath();
        }
    }
    /**
     * @Route("/create-file/{filename}", name="createfile")
     */
    public function createFile($filename)
    {
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // create a new file
        try {
            $new_file_path = $current_dir_path .  "/fsi/" . $filename;;

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
     * @Route("/write-in-file/{filename}/{text}", name="writefile")
     */
    public function writeInFile($filename, $text)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // write çin file
        try {
            $file_path = $current_dir_path . "/fsi/" . $filename;

            if ($fsObject->exists($file_path)) {
                $fsObject->chmod($file_path, 0777);
                $fsObject->appendToFile($file_path, $text);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new Response('<html><h1>write</h1></html>');
    }
    /**
     * @Route("/delete-file/{filename}", name="deletefile")
     */
    public function deleteFile($filename)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // delete file
        try {
            $file_path = $current_dir_path . "/fsi/" . $filename;

            if ($fsObject->exists($file_path)) {
                $fsObject->chmod($file_path, 0777);
                // $filename = iterator_to_array($filename, false);
                $fsObject->remove($file_path);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }

        return new Response('<html><h1>deleted</h1></html>');
    }

    /**
     * @Route("/read-file/{filename}", name="readfile")
     */
    public function readFile($filename)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // read file
        try {
            $file_path = $current_dir_path . "/fsi/" . $filename;
            //   $read = fopen($file_path, "r");
            if ($fsObject->exists($file_path)) {
                $fsObject->chmod($file_path, 0777);
                $finder = new Finder();
                $finder->files()->in($current_dir_path . "/fsi");
                foreach ($finder as $file) {
                    $contents = $file->getContents();
                    print($contents);
                }
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        // return new JsonResponse(json_encode($contents));
        // return $this->render('default/test.html.twig');
        return new Response('<html><h1>read</h1></html>');
    }
}
