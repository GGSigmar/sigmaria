<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\SettingFoundation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends BaseController
{
    /**
     * @Route("/setting/foundations", name="setting_foundations")
     * @Template("setting\information_page\setting_foundations.html.twig")
     */
    public function settingKeystonesAction()
    {
        $foundations = $this->getDoctrine()->getRepository(SettingFoundation::class)->getSortedActiveSettingKeystones();

        $templateData = [
            'foundations' => $foundations,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}