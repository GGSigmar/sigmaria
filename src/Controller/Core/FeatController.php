<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Feat;
use App\Service\Core\UtilityService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class FeatController extends BaseController
{
    /**
     * @Route("/core/feat/list", name="feat_list")
     * @Template("core/feat/list.html.twig")
     */
    public function listFeatsAction()
    {
        $feats = $this->getDoctrine()->getRepository(Feat::class)->findAll();

        $templateData = [
            'feats' => $feats,
            'entityName' => Feat::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/core/feat/general", name="feat_general_display")
     * @Template("core/feat/general_feats.html.twig")
     */
    public function generalFeatsAction()
    {
        $feats = $this->getDoctrine()->getRepository(Feat::class)->getGeneralFeats();

        $templateData = [
            'feats' => UtilityService::groupFeatsByLevel($feats),
            'entityName' => Feat::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/core/feat/{id}/show", name="feat_show")
     * @Template("core/feat/show.html.twig")
     */
    public function showFeatAction(Feat $feat)
    {
        $templateData = [
            'feat' => $feat,
            'isGeneral' => $feat->isGeneral(),
            'entityName' => Feat::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}