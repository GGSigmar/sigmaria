<?php

namespace App\Entity\Campaign;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Campaign\QuestStatusRepository")
 * @ORM\Table(name="campaign_quest_status")
 */
class QuestStatus
{
    use BaseFieldsTrait, HandleTrait, TimestampableEntity;
}