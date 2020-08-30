<?php

namespace App\Controller\Base;

use http\Exception\InvalidArgumentException;
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
    public const NAV_TAB_MISC = 'MISC_TAB';

    public const ENTITY_CREATE_ACTION = 'create';
    public const ENTITY_EDIT_ACTION = 'edit';
    public const ENTITY_KILL_ACTION = 'kill';
    public const ENTITY_REVIVE_ACTION = 'revive';
    public const ENTITY_STAGE_ACTION = 'stage';
    public const ENTITY_UNSTAGE_ACTION = 'unstage';
    public const ENTITY_DELETE_ACTION = 'delete';

    public const ENTITY_CREATED_FORMAT = '%s created!';
    public const ENTITY_EDITED_FORMAT = '%s edited!';
    public const ENTITY_KILLED_FORMAT = '%s killed!';
    public const ENTITY_REVIVED_FORMAT = '%s revived!';
    public const ENTITY_STAGED_FORMAT = '%s staged!';
    public const ENTITY_UNSTAGED_FORMAT = '%s unstaged!';
    public const ENTITY_DELETED_FORMAT = '%s deleted!';

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

    protected function addEntityActionFlash(string $entityName, string $action): void
    {
        switch ($action) {
            case self::ENTITY_CREATE_ACTION:
                $this->addFlash('success', sprintf(self::ENTITY_CREATED_FORMAT, $entityName));
                break;
            case self::ENTITY_EDIT_ACTION:
                $this->addFlash('success', sprintf(self::ENTITY_EDITED_FORMAT, $entityName));
                break;
            case self::ENTITY_KILL_ACTION:
                $this->addFlash('warning', sprintf(self::ENTITY_KILLED_FORMAT, $entityName));
                break;
            case self::ENTITY_REVIVE_ACTION:
                $this->addFlash('success', sprintf(self::ENTITY_REVIVED_FORMAT, $entityName));
                break;
            case self::ENTITY_STAGE_ACTION:
                $this->addFlash('success', sprintf(self::ENTITY_STAGED_FORMAT, $entityName));
                break;
            case self::ENTITY_UNSTAGE_ACTION:
                $this->addFlash('warning', sprintf(self::ENTITY_UNSTAGED_FORMAT, $entityName));
                break;
            case self::ENTITY_DELETE_ACTION:
                $this->addFlash('error', sprintf(self::ENTITY_DELETED_FORMAT, $entityName));
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Action %s not recognized!', $action));
        }
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