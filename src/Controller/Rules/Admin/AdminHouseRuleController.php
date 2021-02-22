<?php
declare(strict_types=1);

namespace App\Controller\Rules\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Rules\HouseRule;
use App\Service\Helper\EntityControllerHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminHouseRuleController extends BaseController
{
    /**
     * @Route("admin/rules/house-rule//list", name="admin_rules_house_rule_list")
     * @Template("rules/house_rules/list.html.twig")
     */
    public function listHouseRulesAction(EntityControllerHelper $entityControllerHelper)
    {
        $templateData = [
            'houseRules' => $entityControllerHelper->getEntityArrayForList(HouseRule::class),
            'entityName' => HouseRule::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}