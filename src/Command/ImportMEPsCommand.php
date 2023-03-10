<?php

namespace App\Command;

use App\Service\MEPImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportMEPsCommand extends Command
{
    protected static $defaultName = 'app:import-meps';
    private $mepImporter;

    public function __construct(MEPImporter $mepImporter)
    {
        $this->mepImporter = $mepImporter;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $meps = $this->mepImporter->import();

        // Output the MEPs to the console for testing purposes
        foreach ($meps as $mep) {
            $output->writeln(sprintf('%d - %s - %s - %s ', $mep->getId(), $mep->getFullName(), $mep->getCountry(), $mep->getNationalPoliticalGroup()));
        }

        return Command::SUCCESS;
    }
}
