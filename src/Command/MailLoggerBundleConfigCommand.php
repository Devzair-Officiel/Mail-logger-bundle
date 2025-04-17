<?php

declare(strict_types=1);

namespace DevZair\MailLoggerBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use DevZair\MailLoggerBundle\Entity\LoggedEmail;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailLoggerBundleConfigCommand extends Command
{
    protected static $defaultName = 'mail:config';
    protected static $defaultDescription = 'Affiche la configuration active du MailLoggerBundle';

    /**
     * @var ParameterBagInterface
     */
    private $params;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->params = $params;
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $enabled = $this->params->get('mail_logger.enabled') ?? false;
        $totalLogs = $this->em->getRepository(LoggedEmail::class)->count([]);

        $output->writeln("<info>📦 MailLoggerBundle - Configuration actuelle</info>");
        $output->writeln(str_repeat('-', 50));
        $output->writeln("🛠  Logging activé : " . ($enabled ? '<fg=green>OUI ✅</>' : '<fg=red>NON ❌</>'));
        $output->writeln("📄 Total de mails loggés : <fg=cyan>$totalLogs</>");
        $output->writeln("📁 Fichier de config : config/packages/mail_logger.yaml");
        $output->writeln("⚙️  Paramètre Symfony : mail_logger.enabled = " . var_export($enabled, true));
        $output->writeln(str_repeat('-', 50));

        return Command::SUCCESS;
    }
}
