<?php

namespace App\Service\Core;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use App\Form\Core\ReleaseMergeType;
use App\Model\Core\ReleaseContentBag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class ReleaseService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /** @var FeatHelper */
    private $featHelper;

    /** @var Release */
    private $release;

    /** @var ReleaseContentBag|null */
    private $contentBag = null;

    public function __construct(
        EntityManagerInterface $em,
        FeatHelper $featHelper
    ) {
        $this->em = $em;
        $this->featHelper = $featHelper;
    }

    /**
     * @param Release $release
     * @return Release
     */
    public function releaseContent(Release $release): Release
    {
        $this->release = $release;
        $this->getContentForNewRelease();

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

    public function getContentForNewRelease(): ReleaseContentBag
    {
        $contentBag = new ReleaseContentBag();

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

    /**
     * @param Release[] $oldReleases
     * @return ReleaseContentBag
     */
    public function getContentForMerge(array $oldReleases): ReleaseContentBag
    {
        $contentBag = new ReleaseContentBag();

        $feats = [];
        $ancestries = [];
        $heritages = [];
        $cultures = [];
        $backgrounds = [];
        $languages = [];

        /** @var Release $oneOldRelease */
        foreach ($oldReleases as $oneOldRelease) {
            $feats = array_merge($feats, $oneOldRelease->getFeats()->toArray());
            $ancestries = array_merge($ancestries, $oneOldRelease->getAncestries()->toArray());
            $heritages = array_merge($heritages, $oneOldRelease->getHeritages()->toArray());
            $cultures = array_merge($cultures, $oneOldRelease->getCultures()->toArray());
            $backgrounds = array_merge($backgrounds, $oneOldRelease->getBackgrounds()->toArray());
            $languages = array_merge($languages, $oneOldRelease->getLanguages()->toArray());

            $this->em->remove($oneOldRelease);
        }

        $contentBag->setAncestries($ancestries);
        $contentBag->setHeritages($heritages);
        $contentBag->setCultures($cultures);
        $contentBag->setFeats($feats);
        $contentBag->setBackgrounds($backgrounds);
        $contentBag->setLanguages($languages);

        $this->contentBag = $contentBag;
        return $contentBag;
    }

    public function mergeReleasesIntoNewOne(array $formData): Release
    {
        $newRelease = new Release();
        $newRelease->setName($formData[ReleaseMergeType::FIELD_NAME]);
        $newRelease->setContentVersion($formData[ReleaseMergeType::FIELD_NAME]);
        $newRelease->setLaunchDate($formData[ReleaseMergeType::LAUNCH_DATE_NAME]);

        $this->getContentForMerge($formData[ReleaseMergeType::FIELD_RELEASES]->toArray());

        $this->release = $newRelease;

        $this->releaseFeatsForMerge();
        $this->releaseAncestries();
        $this->releaseHeritages();
        $this->releaseCultures();
        $this->releaseBackgrounds();
        $this->releaseLanguages();

        $this->em->persist($newRelease);
        $this->em->flush();

        return $newRelease;
    }

    private function releaseFeats(): void
    {
        $feats = $this->contentBag->getFeats();
        $newFeats = [];
        $updatedFeats = [];

        if ($feats) {
            foreach ($feats as $feat) {
                $edits = $feat->getEdits();

                if ($feat->isActive() && $edits) {
                    $this->featHelper->applyEdits($feat);
                    $feat->setEdits(null);
                    $this->em->remove($edits);
                    $updatedFeats[] = $feat;
                } else {
                    $feat->setIsActive(true);
                    $feat->setRelease($this->release);
                    $newFeats[] = $feat;
                }

                $this->em->persist($feat);
            }

            $this->release->setFeats(new ArrayCollection($newFeats));
            $this->release->setUpdatedFeats(new ArrayCollection($updatedFeats));
        }
    }

    private function releaseFeatsForMerge()
    {
        $feats = $this->contentBag->getFeats();

        if ($feats) {
            foreach ($feats as $oneFeat) {
                $oneFeat->setIsActive(true);
                $oneFeat->setRelease($this->release);
                $this->em->persist($oneFeat);
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