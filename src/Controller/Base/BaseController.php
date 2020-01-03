<?php

namespace App\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    public const NAV_TAB_HOME = 'HOME_TAB';
    public const NAV_TAB_RULES = 'RULES_TAB';
    public const NAV_TAB_CAMPAIGN = 'CAMPAIGN_TAB';
    public const NAV_TAB_SETTING = 'SETTING_TAB';
    public const NAV_TAB_ADMIN = 'ADMIN_TAB';

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
    private function getNavigationTemplateData(string $navTabName): array
    {
        $navigationData = [
            'navTab' => $navTabName
        ];

        return $navigationData;
    }
}