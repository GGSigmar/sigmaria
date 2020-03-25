<?php

namespace App\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    public const NAV_TAB_HOME = 'HOME_TAB';
    public const NAV_TAB_BLOG = 'BLOG_TAB';
    public const NAV_TAB_CAMPAIGN = 'CAMPAIGN_TAB';
    public const NAV_TAB_RULES = 'RULES_TAB';
    public const NAV_TAB_SETTING = 'SETTING_TAB';
    public const NAV_TAB_ADMIN = 'ADMIN_TAB';

    /**
     * @param string $navTabName
     *
     * @return array
     */
    protected function getTemplateData(string $navTabName): array
    {
        return array_merge($this->getNavigationTemplateData($navTabName), $this->getSecurityTemplateData());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToReferer(Request $request): RedirectResponse
    {
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @param string $navTabName
     *
     * @return array
     */
    private function getNavigationTemplateData(string $navTabName): array
    {
        return [
            'navTab' => $navTabName
        ];
    }

    private function getSecurityTemplateData(): array
    {
        return [
            'isAdmin' => $this->isGranted('ROLE_ADMIN'),
            'canPreview' => $this->isGranted('CONTENT_PREVIEW'),
        ];
    }
}