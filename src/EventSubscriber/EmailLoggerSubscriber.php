<?php

namespace DevZair\MailLoggerBundle\EventSubscriber;

use DevZair\MailLoggerBundle\Service\EmailLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\SentMessageEvent;
use Symfony\Component\Mailer\Event\FailedMessageEvent;

final class EmailLoggerSubscriber implements EventSubscriberInterface
{
    public function __construct(private EmailLogger $logger) {}

    public static function getSubscribedEvents(): array
    {
        return [
            SentMessageEvent::class => 'onSent',
            FailedMessageEvent::class => 'onFailed',
        ];
    }

    public function onSent(SentMessageEvent $event): void
    {
        $this->logger->logSent($event);
    }

    public function onFailed(FailedMessageEvent $event): void
    {
        $this->logger->logFailed($event);
    }
}
