<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Paragraph;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminParagraphController extends BaseController
{
    /**
     * @Route("/admin/core/paragraph/{id}/kill", name="paragraph_kill")
     */
    public function killParagraphAction(Request $request, Paragraph $paragraph)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $paragraph->setIsActive(false);

        $entityManager->persist($paragraph);
        $entityManager->flush();

        $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/admin/core/paragraph/{id}/revive", name="paragraph_revive")
     */
    public function reviveParagraphAction(Request $request, Paragraph $paragraph)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $paragraph->setIsActive(true);

        $entityManager->persist($paragraph);
        $entityManager->flush();

        $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/admin/core/paragraph/{id}/delete", name="paragraph_delete")
     */
    public function deleteParagraphAction(Request $request, Paragraph $paragraph)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($paragraph);
        $entityManager->flush();

        $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToReferer($request);
    }
}