<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\FileSystemImproved;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );
        $test = new FileSystemImproved();
        $current_dir_path = getcwd();
        $file_path = $current_dir_path . "/fsi/file1";
        $test->writeInFile('file1', $message);
        // Customize your response object to display the exception details
        $test = new Response();
        $test->setContent($message);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $test->setStatusCode($exception->getStatusCode());
            $test->headers->replace($exception->getHeaders());
        } else {
            $test->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        // sends the modified response object to the event
        $event->setResponse($test);
    }
}
