<?php

use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispat
{
    public function Dispatcher()
    {
        $dispatcher = new EventDispatcher;
        $dispatcher->addListener('a file created', function () {
            
            $test = new FileSystemImproved();
            $test->writeInFile('history', 'msg: a file has been created');
        }
    }
}
