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

    public function allfiles()
    {
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        $finder = new Finder();
        // find all files in the current directory
        $test = $finder->files()->in($current_dir_path . '/fsi');

        $l = iterator_to_array($test);
        //var_dump($l);
        //  foreach ($l as $key => $value)
        //      echo $value;
        // check if there are any search results
        if ($finder->hasResults()) {
            echo 'Files in this folder: ';
        }
        foreach ($finder as $file) {
            // $absoluteFilePath = $file->getRealPath();
            $fileNameWithExtension = $file->getRelativePathname();
            //$l =  print();
        }
        return new JsonResponse(json_encode($fileNameWithExtension));
        //return new Response('<html><h1>created</h1></html>');
    }
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

    public function writeInFile($filename, $text)
    { // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // write çin file
        try {
            $file_path = $current_dir_path . "/fsi/" . $filename;

            if ($fsObject->exists($file_path)) {
                //$fsObject->chmod($file_path, 0777);
                //  $fsObject = fopen($file_path, 'r');
                //  fseek($fsObject, 0);
                //  fwrite($file_path, $text);
                $fsObject->appendToFile($file_path, $text);
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new Response('<html><h1>write</h1></html>');
    }

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
                $resp = true;
                // echo " true";
            } else  $resp = false;
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }
        return new JsonResponse(json_encode($resp));
        // return new Response('<html><h1>deleted</h1></html>');
    }

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
        return new JsonResponse(json_encode($contents));
        // return $this->render('default/test.html.twig');
        return new Response('<html><h1>read</h1></html>');
    }
}
