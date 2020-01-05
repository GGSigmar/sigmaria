<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Background;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class BackgroundController extends BaseController
{
    /**
     * @Route("/setting/background/list", name="background_list")
     * @Template("setting/background/list.html.twig")
     */
    public function listBackgroundsAction()
    {
        $backgrounds = $this->getDoctrine()->getRepository(Background::class)->findAll();

        $templateData = [
            'backgrounds' => $backgrounds,
            'entityName' => 'background',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }

    /**
     * @Route("/setting/background/{id}/show", name="background_show")
     * @Template("setting/background/show.html.twig")
     */
    public function showBackgroundAction(Background $background)
    {
        $templateData = [
            'background' => $background,
            'entityName' => 'background',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}