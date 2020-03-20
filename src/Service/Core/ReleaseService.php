<?php

namespace App\Service\Core;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use Doctrine\ORM\EntityManagerInterface;

class ReleaseService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Release
     */
    private $release;

    /**
     * @var array
     */
    private $releaseData;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Release $release
     * @return Release
     */
    public function releaseContent(Release $release): Release
    {
        $this->release = $release;
        $this->releaseData = [];

        $this->releaseAncestries();
        $this->releaseHeritages();
        $this->releaseCultures();
        $this->releaseFeats();
        $this->releaseBackgrounds();
        $this->releaseLanguages();

        $release->setContentReleased($this->releaseData);

        $this->em->persist($release);
        $this->em->flush();

        return $release;
    }

    /**
     * @return array
     */
    public function getContentToBeReleased(): array
    {
        $contentToBeReleased = [];

        $ancestryRepository = $this->em->getRepository(Ancestry::class);
        $ancestriesToBeReleased = $ancestryRepository->getAncestriesForRelease();

        if ($ancestriesToBeReleased) {
            $contentToBeReleased['ancestry'] = $ancestriesToBeReleased;
        }

        $heritageRepository = $this->em->getRepository(Heritage::class);
        $heritagesToBeReleased = $heritageRepository->getHeritagesForRelease();

        if ($heritagesToBeReleased) {
            $contentToBeReleased['heritage'] = $heritagesToBeReleased;
        }

        $cultureRepository = $this->em->getRepository(Culture::class);
        $culturesToBeReleased = $cultureRepository->getCulturesForRelease();

        if ($culturesToBeReleased) {
            $contentToBeReleased['culture'] = $culturesToBeReleased;
        }

        $featRepository = $this->em->getRepository(Feat::class);
        $featsToBeReleased = $featRepository->getFeatsForRelease();

        if ($featsToBeReleased) {
            $contentToBeReleased['feat'] = $featsToBeReleased;
        }

        $backgroundRepository = $this->em->getRepository(Background::class);
        $backgroundsToBeReleased = $backgroundRepository->getBackgroundsForRelease();

        if ($backgroundsToBeReleased) {
            $contentToBeReleased['background'] = $backgroundsToBeReleased;
        }

        $languageRepository = $this->em->getRepository(Language::class);
        $languagesToBeReleased = $languageRepository->getLanguagesForRelease();

        if ($languagesToBeReleased)
        {
            $contentToBeReleased['language'] = $languagesToBeReleased;
        }

        return $contentToBeReleased;
    }

    private function releaseAncestries(): void
    {
        $ancestryRepository = $this->em->getRepository(Ancestry::class);

        $ancestriesToBeReleased = $ancestryRepository->getAncestriesForRelease();

        if ($ancestriesToBeReleased) {
            foreach ($ancestriesToBeReleased as $ancestry) {
                $ancestry->setIsActive(true);
                $this->releaseData['ancestry'][$ancestry->getId()] = $ancestry->getName();
                $ancestry->setRelease($this->release);
                $this->em->persist($ancestry);
            }
        }
    }

    private function releaseHeritages(): void
    {
        $heritageRepository = $this->em->getRepository(Heritage::class);

        $heritagesToBeReleased = $heritageRepository->getHeritagesForRelease();

        if ($heritagesToBeReleased) {
            foreach ($heritagesToBeReleased as $heritage) {
                $heritage->setIsActive(true);
                $this->releaseData['heritage'][$heritage->getId()] = $heritage->getName();
                $heritage->setRelease($this->release);
                $this->em->persist($heritage);
            }
        }
    }

    private function releaseCultures(): void
    {
        $cultureRepository = $this->em->getRepository(Culture::class);

        $culturesToBeReleased = $cultureRepository->getCulturesForRelease();

        if ($culturesToBeReleased) {
            foreach ($culturesToBeReleased as $culture) {
                $culture->setIsActive(true);
                $this->releaseData['culture'][$culture->getId()] = $culture->getName();
                $culture->setRelease($this->release);
                $this->em->persist($culture);
            }
        }
    }

    private function releaseFeats(): void
    {
        $featRepository = $this->em->getRepository(Feat::class);

        $featsToBeReleased = $featRepository->getFeatsForRelease();

        if ($featsToBeReleased) {
            foreach ($featsToBeReleased as $feat) {
                $feat->setIsActive(true);
                $this->releaseData['feat'][$feat->getId()] = $feat->getName();
                $feat->setRelease($this->release);
                $this->em->persist($feat);
            }
        }
    }

    private function releaseBackgrounds(): void
    {
        $backgroundRepository = $this->em->getRepository(Background::class);

        $backgroundsToBeReleased = $backgroundRepository->getBackgroundsForRelease();

        if ($backgroundsToBeReleased) {
            foreach ($backgroundsToBeReleased as $background) {
                $background->setIsActive(true);
                $this->releaseData['background'][$background->getId()] = $background->getName();
                $background->setRelease($this->release);
                $this->em->persist($background);
            }
        }
    }

    private function releaseLanguages(): void
    {
        $languageRepository = $this->em->getRepository(Language::class);

        $languagesToBeReleased = $languageRepository->getLanguagesForRelease();

        if ($languagesToBeReleased) {
            foreach ($languagesToBeReleased as $language) {
                $language->setIsActive(true);
                $this->releaseData['language'][$language->getId()] = $language->getName();
                $language->setRelease($this->release);
                $this->em->persist($language);
            }
        }
    }
}