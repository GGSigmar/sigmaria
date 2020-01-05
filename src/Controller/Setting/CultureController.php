<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Culture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class CultureController extends BaseController
{
    /**
     * @Route("/setting/culture/list", name="culture_list")
     * @Template("setting/culture/list.html.twig")
     */
    public function listCulturesAction()
    {
        $cultures = $this->getDoctrine()->getRepository(Culture::class)->findAll();

        $templateData = [
            'cultures' => $cultures,
            'entityName' => 'culture',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }

    /**
     * @Route("/setting/culture/{id}/show", name="culture_show")
     * @Template("setting/culture/show.html.twig")
     */
    public function showCultureAction(Culture $culture)
    {
        $templateData = [
            'culture' => $culture,
            'entityName' => 'culture',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}