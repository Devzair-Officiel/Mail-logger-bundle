<?php

namespace App\Command;

use App\MailLoggerBundle\Entity\LoggedEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mail:log',
    description: 'Liste les derniers emails envoyés (avec option --json)',
)]
class MailLogCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'json',
                null,
                InputOption::VALUE_NONE,
                'Afficher les logs au format JSON'
            )
            ->addOption(
                'limit',
                null,
                InputOption::VALUE_REQUIRED,
                'Nombre de logs à afficher',
                10
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = (int) $input->getOption('limit');
        $asJson = $input->getOption('json');

        $logs = $this->em->getRepository(LoggedEmail::class)
            ->findBy([], ['sentAt' => 'DESC'], $limit);

        if (empty($logs)) {
            $output->writeln('<comment>Aucun email trouvé.</comment>');
            return Command::SUCCESS;
        }

        if ($asJson) {
            $data = [];

            foreach ($logs as $log) {
                $data[] = [
                    'from' => $log->getFrom(),
                    'to' => $log->getTo(),
                    'cc' => $log->getCc(),
                    'bcc' => $log->getBcc(),
                    'reply_to' => $log->getReplyTo(),
                    'return_path' => $log->getReturnPath(),
                    'subject' => $log->getSubject(),
                    'body' => $log->getBody(),
                    'sent_at' => $log->getSentAt()->format('Y-m-d H:i:s'),
                    'result' => $log->getResult(),
                    'failed_recipients' => $log->getFailedRecipients(),
                ];
            }

            $output->writeln(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } else {
            foreach ($logs as $log) {
                $from = $this->stringifyAddresses($log->getFrom() ?? []);
                $to = $this->stringifyAddresses($log->getTo() ?? []);

                $output->writeln(sprintf(
                    "<info>%s</info> • <comment>%s</comment> ➜ <fg=cyan>%s</>",
                    $log->getSentAt()->format('Y-m-d H:i'),
                    $from,
                    $to
                ));

                $output->writeln('  Sujet : ' . $log->getSubject());
                $output->writeln('  Statut : ' . $log->getResult());
                $output->writeln(str_repeat('-', 50));
            }
        }

        return Command::SUCCESS;
    }

    private function stringifyAddresses(array $addresses): string
    {
        $output = [];

        foreach ($addresses as $entry) {
            if (is_array($entry)) {
                $email = $entry['email'] ?? '';
                $name = $entry['name'] ?? '';
                $output[] = $name ? "$name <$email>" : $email;
            } elseif (is_string($entry)) {
                $output[] = $entry;
            }
        }

        return implode(', ', $output);
    }
}
