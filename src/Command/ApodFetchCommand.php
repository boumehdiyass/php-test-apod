<?php

namespace App\Command;

use App\Service\PictureService;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ApodFetchCommand extends Command
{
    /**
     * @var PictureService
     */
    protected PictureService $pictureService;

    /**
     * ApodFetchCommand constructor.
     * @param PictureService $pictureService
     */
    public function __construct(PictureService $pictureService)
    {
        parent::__construct();
        $this->pictureService = $pictureService;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:apod:fetch')
            ->setDescription('fetch the picture of the day from NASA APOD API and save it in database')
            ->addOption('date', null, InputOption::VALUE_OPTIONAL, 'Date for picture (format: Y-m-d, default: today)', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $date = $input->getOption('date') ? DateTime::createFromFormat('Y-m-d', $input->getOption('date')) : new DateTime();
        if ($this->pictureService->addFromApod($date)) {
            $io->success("Picture of the date " . $date->format('Y-m-d') . " is saved successfully.");
        } else {
            $io->success("No picture found for specified date " . $date->format('Y-m-d') . ".");
        }
        return Command::SUCCESS;
    }
}
