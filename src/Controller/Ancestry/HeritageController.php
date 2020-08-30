<?php

namespace App\Controller\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Heritage;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HeritageController extends BaseController
{
    /**
     * @Route("/ancestry/heritage/list", name="heritage_list")
     * @Template("ancestry/heritage/list.html.twig")
     */
    public function listHeritagesAction()
    {
        $heritages = $this->getDoctrine()->getRepository(Heritage::class)->findAll();

        $templateData = [
            'heritages' => $heritages,
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/ancestry/heritage/{slug}/show", name="heritage_show")
     * @Template("ancestry/heritage/show.html.twig")
     */
    public function showHeritageAction(Heritage $heritage)
    {
        $this->denyAccessUnlessGranted('view', $heritage);

        $templateData = [
            'heritage' => $heritage,
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}