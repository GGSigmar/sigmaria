<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Lore;
use App\Form\Core\LoreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminLoreController extends BaseController
{
    /**
     * @Route("/admin/core/lore/list", name="lore_list")
     * @Template("core/lore/list.html.twig")
     */
    public function listLoresAction()
    {
        $lores = $this->getDoctrine()->getRepository(Lore::class)->findAll();

        $templateData = [
            'lores' => $lores,
            'entityName' => 'lore',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/create", name="lore_create")
     * @Template("core/lore/form.html.twig")
     */
    public function createLoreAction(Request $request)
    {
        $form = $this->createForm(LoreType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lore = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lore);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzina wiedzy stworzona!');

            return $this->redirectToRoute('lore_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'lore',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/{id}/edit", name="lore_edit")
     * @Template("core/lore/form.html.twig")
     */
    public function editLoreAction(Request $request, Lore $lore)
    {
        $form = $this->createForm(LoreType::class, $lore);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lore = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lore);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzina wiedzy zmieniona!');

            return $this->redirectToRoute('lore_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'lore',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/{id}/kill", name="lore_kill")
     */
    public function killLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $lore->setIsActive(false);

        $entityManager->persist($lore);
        $entityManager->flush();

        $this->addFlash('warning', 'Dziedzina wiedzy zabita!');

        return $this->redirectToRoute('lore_list');
    }

    /**
     * @Route("/admin/core/lore/{id}/revive", name="lore_revive")
     */
    public function reviveLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $lore->setIsActive(true);

        $entityManager->persist($lore);
        $entityManager->flush();

        $this->addFlash('success', 'Dziedzina wiedzy wskrzeszona!');

        return $this->redirectToRoute('lore_list');
    }

    /**
     * @Route("/admin/core/lore/{id}/delete", name="lore_delete")
     */
    public function deleteLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($lore);
        $entityManager->flush();

        $this->addFlash('danger', 'Dziedzina wiedzy usunięta!');

        return $this->redirectToRoute('lore_list');
    }
}