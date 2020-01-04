<?php

namespace App\Command;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Repository\Ancestry\AncestryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ReleaseContentCommand extends Command
{
    use LockableTrait;

    protected static $defaultName = 'content:release';

    private const ANCESTRY_RELEASE_MESSAGE = 'Wydawanie rasy %s';
    private const FEAT_RELEASE_MESSAGE = 'Wydawanie atutu %s';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Aktywuje zawartość przygotowaną do wydania.')
            ->setHelp('Aktywuje zawartość przygotowaną do wydania.')
            ->addOption('apply', null, InputOption::VALUE_NONE, 'Czy zapisać zmiany? (flush)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('Ta komenda jest już wykonywana w innym procesie.');

            return 0;
        }

        $output->writeln('Rozpoczynanie wydania!');

        $apply = $input->getOption('apply');

        if ($apply) {
            $output->writeln('Zmiany będą zapisane!');
        } else {
            $output->writeln('Zmiany NIE będą zapisane!');
        }

        $helper = $this->getHelper('question');

        $nameQuestion = new Question('Podaj nazwę nowego wydania');
        $releaseName = $helper->ask($input, $output, $nameQuestion);

        $versionQuestion = new Question('Podaj number nowej wersji zawartości');
        $contentVersion = $helper->ask($input, $output, $versionQuestion);

        $release = new Release();
        $release->setName($releaseName);
        $release->setContentVersion($contentVersion);

        $releasedDataArray = [];

        /* wydanie ras */

        $ancestryRepository = $this->em->getRepository(Ancestry::class);

        $ancestriesToBeReleased = $ancestryRepository->getAncestriesForRelease();

        if ($ancestriesToBeReleased) {
            foreach ($ancestriesToBeReleased as $ancestry) {
                $ancestry->setIsActive(true);
                $releasedDataArray['ancestry'][$ancestry->getId()] = $ancestry->getName();
                $ancestry->setRelease($release);
                $this->em->persist($ancestry);
            }
        }

        /* wydanie atutów */

        $featRepository = $this->em->getRepository(Feat::class);

        $featsToBeReleased = $featRepository->getFeatsForRelease();

        if ($featsToBeReleased) {
            foreach ($featsToBeReleased as $feat) {
                $feat->setIsActive(true);
                $releasedDataArray['feat'][$feat->getId()] = $feat->getName();
                $feat->setRelease($release);
                $this->em->persist($feat);
            }
        }

        $release->setContentReleased($releasedDataArray);

        $this->em->persist($release);

        if ($apply) {
            $this->em->flush();
        }

        $this->release();
        $output->write('Gotowe!');

        return 1;
    }
}