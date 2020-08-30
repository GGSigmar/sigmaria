<?php

namespace App\Controller\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AncestryController extends BaseController
{
    /**
     * @Route("/ancestry/list", name="ancestry_list")
     * @Template("ancestry/ancestry/list.html.twig")
     */
    public function listAncestriesAction()
    {
        $ancestries = $this->getDoctrine()->getRepository(Ancestry::class)->getAllAncestriesSorted();

        $templateData = [
            'ancestries' => $ancestries,
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/{slug}/show", name="ancestry_show")
     * @Template("ancestry/ancestry/show.html.twig")
     */
    public function showAncestryAction(Ancestry $ancestry)
    {
        $this->denyAccessUnlessGranted('view', $ancestry);

        $templateData = [
            'ancestry' => $ancestry,
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}