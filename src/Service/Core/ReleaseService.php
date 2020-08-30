<?php

namespace App\Service\Core;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ContentToBeReleasedBag|null
     */
    private $contentBag = null;

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
        $this->getContentToBeReleased();

        $this->releaseFeats();
        $this->releaseAncestries();
        $this->releaseHeritages();
        $this->releaseCultures();
        $this->releaseBackgrounds();
        $this->releaseLanguages();

        $this->release->setLaunchDate(new \DateTime());
        $this->em->persist($release);
        $this->em->flush();

        return $release;
    }

    /**
     * @return ContentToBeReleasedBag
     */
    public function getContentToBeReleased(): ContentToBeReleasedBag
    {
        $contentBag = new ContentToBeReleasedBag();

        $ancestryRepository = $this->em->getRepository(Ancestry::class);
        $contentBag->setAncestries($ancestryRepository->getAncestriesForRelease());

        $heritageRepository = $this->em->getRepository(Heritage::class);
        $contentBag->setHeritages($heritageRepository->getHeritagesForRelease());

        $cultureRepository = $this->em->getRepository(Culture::class);
        $contentBag->setCultures($cultureRepository->getCulturesForRelease());

        $featRepository = $this->em->getRepository(Feat::class);
        $contentBag->setFeats($featRepository->getFeatsForRelease());

        $backgroundRepository = $this->em->getRepository(Background::class);
        $contentBag->setBackgrounds($backgroundRepository->getBackgroundsForRelease());

        $languageRepository = $this->em->getRepository(Language::class);
        $contentBag->setLanguages($languageRepository->getLanguagesForRelease());

        $this->contentBag = $contentBag;
        return $contentBag;
    }

    private function releaseFeats(): void
    {
        $feats = $this->contentBag->getFeats();

        if ($feats) {
            foreach ($feats as $feat) {
                $feat->setIsActive(true);
                $feat->setRelease($this->release);
                $this->em->persist($feat);
            }

            $this->release->setFeats(new ArrayCollection($feats));
        }
    }

    private function releaseAncestries(): void
    {
        $ancestries = $this->contentBag->getAncestries();

        if ($ancestries) {
            foreach ($this->contentBag->getAncestries() as $ancestry) {
                $ancestry->setIsActive(true);
                $ancestry->setRelease($this->release);
                $this->em->persist($ancestry);
            }

            $this->release->setAncestries(new ArrayCollection($ancestries));
        }
    }

    private function releaseHeritages(): void
    {
        $heritages = $this->contentBag->getHeritages();

        if ($heritages) {
            foreach ($heritages as $heritage) {
                $heritage->setIsActive(true);
                $heritage->setRelease($this->release);
                $this->em->persist($heritage);
            }

            $this->release->setHeritages(new ArrayCollection($heritages));
        }
    }

    private function releaseCultures(): void
    {
        $cultures = $this->contentBag->getCultures();

        if ($cultures) {
            foreach ($cultures as $culture) {
                $culture->setIsActive(true);
                $culture->setRelease($this->release);
                $this->em->persist($culture);
            }

            $this->release->setCultures(new ArrayCollection($cultures));
        }
    }

    private function releaseBackgrounds(): void
    {
        $backgrounds = $this->contentBag->getBackgrounds();

        if ($backgrounds) {
            foreach ($backgrounds as $background) {
                $background->setIsActive(true);
                $background->setRelease($this->release);
                $this->em->persist($background);
            }

            $this->release->setBackgrounds(new ArrayCollection($backgrounds));
        }
    }

    private function releaseLanguages(): void
    {
        $languages = $this->contentBag->getLanguages();

        if ($languages) {
            foreach ($languages as $language) {
                $language->setIsActive(true);
                $language->setRelease($this->release);
                $this->em->persist($language);
            }

            $this->release->setLanguages(new ArrayCollection($languages));
        }
    }
}