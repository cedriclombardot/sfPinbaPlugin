<?php

class sfPinbaCommandEventListener
{
    static protected $timers = array();

    public function onPreCommand(sfEvent $event)
    {
        $task = $event->getSubject();
        sfPinbaCommandContext::getInstance()->setScriptName('command://symfony/command-line/'.$task->getFullName());
        self::$timers[$task->getFullName()] = new sfPinbaTimer($task->getFullName());
        self::$timers[$task->getFullName()]->setTags(array('command' => $task->getFullName()));
        self::$timers[$task->getFullName()]->startTimer();
    }

    public function onPostCommand(sfEvent $event)
    {
        $task = $event->getSubject();
        if (self::$timers[$task->getFullName()]->isRunning()) {
            $spent = self::$timers[$task->getFullName()]->addTime();
        }
    }
}