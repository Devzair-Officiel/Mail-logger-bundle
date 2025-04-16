<?php

namespace DevZair\MailLoggerBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'mail:test',
    description: 'Envoie un email de test pour vérifier le système de mail et le logger.'
)]
class MailTestCommand extends Command
{
    public function __construct(
        private MailerInterface $mailer
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (new Email())
            ->from('noreply@yourapp.local')
            ->to('test@dev.local') 
            ->cc('copie@dev.local')
            ->bcc('secret@dev.local')
            ->replyTo('reply@dev.local')
            // ->returnPath('bounce@yourapp.local')
            ->subject('🚀 Email de test')
            ->text('Ceci est un email de test généré via la commande mail:test.')
            ->html('<p><strong>Email de test</strong> généré via <code>mail:test</code>.</p>');

        $this->mailer->send($email);

        $output->writeln('<info>Email de test envoyé avec succès ✅</info>');

        return Command::SUCCESS;
    }
}
