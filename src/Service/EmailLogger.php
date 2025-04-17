<?php

declare(strict_types=1);

namespace DevZair\MailLoggerBundle\Service;

use DevZair\MailLoggerBundle\Entity\LoggedEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;

class EmailLogger
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var bool
     */
    private $loggingEnabled;

    public function __construct(EntityManagerInterface $em, bool $loggingEnabled = true)
    {
        $this->em = $em;
        $this->loggingEnabled = $loggingEnabled;
    }

    public function logFromEvent(MessageEvent $event): void
    {
        // Par défaut, on considère que MessageEvent = succès
        $message = $event->getMessage();

        if ($message instanceof Email) {
            $this->log($message, 'success');
        }
    }

    public function log(RawMessage $message, string $result, ?array $failures = []): void
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
}
