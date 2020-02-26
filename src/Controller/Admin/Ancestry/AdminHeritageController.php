<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Form\Ancestry\HeritageType;
use App\Form\Core\FeatType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminHeritageController extends BaseController
{
    /**
     * @Route("/admin/ancestry/heritage/list", name="heritage_list")
     * @Template("ancestry/heritage/list.html.twig")
     */
    public function listHeritagesAction()
    {
        $heritages = $this->getDoctrine()->getRepository(Heritage::class)->findAll();

        $templateData = [
            'heritages' => $heritages,
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/create", name="heritage_create")
     * @Template("ancestry/heritage/create.html.twig")
     */
    public function createHeritageAction(Request $request)
    {
        $form = $this->createForm(HeritageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzictwo stworzone!');

            return $this->redirectToRoute('heritage_show', ['id' => $heritage->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/edit", name="heritage_edit")
     * @Template("ancestry/heritage/edit.html.twig")
     */
    public function editHeritageAction(Request $request, Heritage $heritage)
    {
        $form = $this->createForm(HeritageType::class, $heritage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzictwo edytowane!');

            return $this->redirectToRoute('heritage_show', ['id' => $heritage->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/kill", name="heritage_kill")
     */
    public function killHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsActive(false);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addFlash('warning', 'Dziedzictwo zabite!');

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/revive", name="heritage_revive")
     */
    public function reviveHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsActive(true);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addFlash('success', 'Dziedzictwo wskrzeszone!');

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/delete", name="heritage_delete")
     */
    public function deleteHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($heritage);
        $entityManager->flush();

        $this->addFlash('danger', 'Dziedzictwo usunięte!');

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/heritage/heritage/{id}/stage", name="heritage_stage")
     */
    public function stageHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsToBeReleased(true);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addFlash('success', 'Dziedzictwo oznaczone do wydania!');

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/heritage/heritage/{id}/unstage", name="heritage_unstage")
     */
    public function unstageHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsToBeReleased(false);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addFlash('warning', 'Dziedzictwo wyłączone z wydania!');

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/feat/create", name="heritage_feat_create")
     * @Template("core/feat/create.html.twig")
     */
    public function createHeritageFeatAction(Request $request, Heritage $heritage)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $heritage->addFeat($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addFlash('success', 'Atut stworzony!');

            return $this->redirectToRoute('heritage_show', ['id' => $heritage->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/heritage/{heritageId}/feat/{featId}/edit", name="heritage_feat_edit")
     * @Template("core/feat/create.html.twig")
     */
    public function editHeritageFeatAction(Request $request, int $heritageId, int $featId)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat = $entityManager->getRepository(Feat::class)->find($featId);

        $form = $this->createForm(FeatType::class, $feat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut zmieniony!');

            return $this->redirectToRoute('heritage_show', ['id' => $heritageId]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}