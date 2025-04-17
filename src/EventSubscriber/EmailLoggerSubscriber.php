<?php

declare(strict_types=1);

namespace DevZair\MailLoggerBundle\EventSubscriber;

use DevZair\MailLoggerBundle\Service\EmailLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\MessageEvent;

final class EmailLoggerSubscriber implements EventSubscriberInterface
{
    /**
     * @var EmailLogger
     */
    private $logger;

    public function __construct(EmailLogger $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MessageEvent::class => 'onMessage',
        ];
    }

    public function onMessage(MessageEvent $event): void
    {
        $this->logger->logFromEvent($event);
    }
}
