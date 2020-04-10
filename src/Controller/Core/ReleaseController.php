<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Release;
use App\Service\Core\ReleaseService;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ReleaseController extends BaseController
{
    /**
     * @Route("/admin/core/release/list", name="release_list")
     * @Template("core/release/list.html.twig")
     */
    public function listReleasesAction()
    {
        $releases = $this->getDoctrine()->getRepository(Release::class)->findAll();

        $templateData = [
            'releases' => $releases,
            'entityName' => 'release',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/{id}/show", name="release_show")
     * @Template("core/release/show.html.twig")
     */
    public function showReleaseAction(Release $release, ReleaseService $releaseService)
    {
        $templateData = [
            'release' => $release,
            'entityName' => 'release',
            'contentToBeReleased' => $releaseService->getContentToBeReleased(),
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}