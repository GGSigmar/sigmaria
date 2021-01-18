<?php

namespace App\Service\Core;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;

class ReleaseContentBag
{
    /**
     * @var Feat[]
     */
    private $feats;

    /**
     * @var Ancestry[]
     */
    private $ancestries;

    /**
     * @var Heritage[]
     */
    private $heritages;

    /**
     * @var Culture[]
     */
    private $cultures;

    /**
     * @var Background[]
     */
    private $backgrounds;

    /**
     * @var Language[]
     */
    private $languages;

    /**
     * @return Feat[]
     */
    public function getFeats(): array
    {
        return $this->feats;
    }

    /**
     * @param Feat[] $feats
     */
    public function setFeats(array $feats): void
    {
        $this->feats = $feats;
    }

    /**
     * @return Ancestry[]
     */
    public function getAncestries(): array
    {
        return $this->ancestries;
    }

    /**
     * @param Ancestry[] $ancestries
     */
    public function setAncestries(array $ancestries): void
    {
        $this->ancestries = $ancestries;
    }

    /**
     * @return Heritage[]
     */
    public function getHeritages(): array
    {
        return $this->heritages;
    }

    /**
     * @param Heritage[] $heritages
     */
    public function setHeritages(array $heritages): void
    {
        $this->heritages = $heritages;
    }

    /**
     * @return Culture[]
     */
    public function getCultures(): array
    {
        return $this->cultures;
    }

    /**
     * @param Culture[] $cultures
     */
    public function setCultures(array $cultures): void
    {
        $this->cultures = $cultures;
    }

    /**
     * @return Background[]
     */
    public function getBackgrounds(): array
    {
        return $this->backgrounds;
    }

    /**
     * @param Background[] $backgrounds
     */
    public function setBackgrounds(array $backgrounds): void
    {
        $this->backgrounds = $backgrounds;
    }

    /**
     * @return Language[]
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param Language[] $languages
     */
    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }
}