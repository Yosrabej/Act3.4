<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use AppBundle\Controller\FileSystemImproved;

class EventDispat
{
  public function Dispatcher()
  {
    $dispatcher = new EventDispatcher;
    $test = new FileSystemImproved();
    $fct = $test->writeInFile('history', 'msg: a file has been created');
    $dispatcher->addListener('a file created', $fct);
  }
}
