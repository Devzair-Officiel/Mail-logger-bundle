<?php

namespace DevZair\MailLoggerBundle\Tests\Service;

use DevZair\MailLoggerBundle\Entity\LoggedEmail;
use DevZair\MailLoggerBundle\Service\EmailLogger;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mime\Email;

class EmailLoggerTest extends TestCase
{
    public function testLogPersistsEmail(): void
    {
        $email = (new Email())
            ->from('dev@dev.local')
            ->to('user@test.com')
            ->subject('Test')
            ->text('Ceci est un test');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('persist')->with($this->isInstanceOf(LoggedEmail::class));
        $em->expects($this->once())->method('flush');

        $logger = new EmailLogger($em, true);
        $r = new \ReflectionMethod($logger, 'log');
        $r->setAccessible(true);
        $r->invoke($logger, $email, 'success', []);
    }
}
