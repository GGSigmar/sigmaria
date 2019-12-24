<?php

namespace App\Controller\Core;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{
    public const NAV_TAB_HOME = 'HOME_TAB';
    public const NAV_TAB_RULES = 'RULES_TAB';
    public const NAV_TAB_CAMPAIGN = 'CAMPAIGN_TAB';
    public const NAV_TAB_SETTING = 'SETTING_TAB';
    public const NAV_TAB_ADMIN = 'ADMIN_TAB';

    /**
     * @Route("/", name="home")
     * @Template("base\base.html.twig")
     */
    public function indexAction()
    {
        return $this->getTemplateData(CoreController::NAV_TAB_HOME);
    }

    /**
     * @param string $navTabName
     *
     * @return array
     */
    protected function getTemplateData(string $navTabName): array
    {
        return $this->getNavigationTemplateData($navTabName);
    }

    /**
     * @param string $navTabName
     *
     * @return array
     */
    protected function getNavigationTemplateData(string $navTabName): array
    {
        $navigationData = [
            'navTab' => $navTabName
        ];

        return $navigationData;
    }
}