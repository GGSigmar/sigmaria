<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\SettingKeystone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends BaseController
{
    /**
     * @Route("/setting/keystones", name="setting_keystones")
     * @Template("setting\information_page\setting_keystones.html.twig")
     */
    public function settingKeystonesAction()
    {
        $keystones = $this->getDoctrine()->getRepository(SettingKeystone::class)->getSortedActiveSettingKeystones();

        $templateData = [
            'keystones' => $keystones,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}