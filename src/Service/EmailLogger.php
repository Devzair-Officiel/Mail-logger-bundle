<?php

namespace DevZair\MailLoggerBundle\Service;

use DevZair\MailLoggerBundle\Entity\LoggedEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Event\SentMessageEvent;
use Symfony\Component\Mailer\Event\FailedMessageEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Mailer\SentMessage;

class EmailLogger
{
    public function __construct(
        private EntityManagerInterface $em,
        private bool $loggingEnabled = true
    ) {}

    public function logSent(SentMessageEvent $event): void
    {
        $sentMessage = $event->getMessage();
        $original = $sentMessage instanceof SentMessage ? $sentMessage->getOriginalMessage() : null;

        if ($original instanceof Email) {
            $this->log($original, 'success');
        }
    }

    public function logFailed(FailedMessageEvent $event): void
    {
        $sentMessage = $event->getMessage();
        $original = $sentMessage instanceof SentMessage ? $sentMessage->getOriginalMessage() : null;

        $failures = []; // on ne log pas les destinataires en erreur (pas disponibles de façon sûre)

        if ($original instanceof Email) {
            $this->log($original, 'failed', $failures);
        }
    }

    private function extractAddresses(array $addresses): array
    {
        $normalized = [];

        foreach ($addresses as $address) {
            if (method_exists($address, 'getAddress')) {
                $normalized[] = [
                    'email' => $address->getAddress(),
                    'name' => $address->getName(),
                ];
            }
        }

        return $normalized;
    }



    private function log(RawMessage $message, string $result, ?array $failures = []): void
    {
        if (!$this->loggingEnabled || !$message instanceof Email) {
            return;
        }

        $log = new LoggedEmail();
        $log->setFrom($this->extractAddresses($message->getFrom()));
        $log->setTo($this->extractAddresses($message->getTo()));
        $log->setCc($this->extractAddresses($message->getCc()));
        $log->setBcc($this->extractAddresses($message->getBcc()));
        $log->setReplyTo($this->extractAddresses($message->getReplyTo()));
        $log->setReturnPath($message->getReturnPath());
        $log->setSubject($message->getSubject());
        $log->setBody($message->getHtmlBody() ?? $message->getTextBody() ?? '');
        $log->setSentAt(new \DateTimeImmutable());
        $log->setResult($result);
        $log->setFailedRecipients($failures);

        $this->em->persist($log);
        $this->em->flush();
    }
}
