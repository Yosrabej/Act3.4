<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Controller\FileSystemImproved;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/state", name="getfiles")
     */

    public function allfiles()
    {
        $fileSystemImproved = new FileSystemImproved();
        $fileSystemImproved->allfiles();
        // return new Response($fileSystemImproved);
        return $this->render('default/test.html.twig');
    }
    /**
     * @Route("/create-file/{filename}", name="createfile")
     */
    public function createFile($filename)
    {
        $fileSystemImproved = new FileSystemImproved();
        $fileSystemImproved->createFile($filename);
        return $this->render('default/test.html.twig');
    }
    /**
     * @Route("/write-in-file/{filename}/{text}", name="writefile")
     */
    public function writeInFile($filename, $text)
    {
        $fileSystemImproved = new FileSystemImproved();
        $fileSystemImproved->writeInFile($filename, $text);
        return $this->render('default/test.html.twig');
    }
    /**
     * @Route("/delete-file/{filename}", name="deletefile")
     */
    public function deleteFile($filename)
    {
        $fileSystemImproved = new FileSystemImproved();
        $fileSystemImproved->deleteFile($filename);
        return $this->render('default/test.html.twig');
    }
    /**
     * @Route("/read-file/{filename}", name="readfile")
     */
    public function readFile($filename)
    {
        $fileSystemImproved = new FileSystemImproved();
        $fileSystemImproved->readFile($filename);
        return $this->render('default/test.html.twig');
    }
}
