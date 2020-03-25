<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Form\Ancestry\AncestryType;
use App\Form\Ancestry\HeritageType;
use App\Form\Core\FeatType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminAncestryController extends BaseController
{
    /**
     * @Route("/admin/ancestry/create", name="ancestry_create")
     * @Template("ancestry/ancestry/create.html.twig")
     */
    public function createAncestryAction(Request $request)
    {
        $form = $this->createForm(AncestryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addFlash('success', 'Rasa stworzona!');

            return $this->redirectToRoute('ancestry_show', ['id' => $ancestry->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'ancestry'
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/edit", name="ancestry_edit")
     * @Template("ancestry/ancestry/edit.html.twig")
     */
    public function editAncestryAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(AncestryType::class, $ancestry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addFlash('success', 'Rasa edytowana!');

            return $this->redirectToRoute('ancestry_show', ['id' => $ancestry->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'ancestry'
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/kill", name="ancestry_kill")
     */
    public function killAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsActive(false);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addFlash('warning', 'Rasa zabita!');

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/revive", name="ancestry_revive")
     */
    public function reviveAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsActive(true);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addFlash('success', 'Rasa wskrzeszona!');

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/delete", name="ancestry_delete")
     */
    public function deleteAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($ancestry);
        $entityManager->flush();

        $this->addFlash('danger', 'Rasa usunięta!');

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/stage", name="ancestry_stage")
     */
    public function stageAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsToBeReleased(true);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addFlash('success', 'Rasa oznaczona do wydania!');

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/unstage", name="ancestry_unstage")
     */
    public function unstageAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsToBeReleased(false);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addFlash('warning', 'Rasa wyłączona z wydania!');

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/feat/create", name="ancestry_feat_create")
     * @Template("core/feat/create.html.twig")
     */
    public function createAncestryFeatAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $ancestry->addFeat($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addFlash('success', 'Atut stworzony!');

            return $this->redirectToRoute('ancestry_show', ['id' => $ancestry->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry//{baseId}/feat/{id}/edit", name="ancestry_feat_edit")
     * @Template("core/feat/edit.html.twig")
     */
    public function editAncestryFeatAction(Request $request, int $baseId, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat = $entityManager->getRepository(Feat::class)->find($id);

        $form = $this->createForm(FeatType::class, $feat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut zmieniony!');

            return $this->redirectToRoute('ancestry_show', ['id' => $baseId]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/heritage/create", name="ancestry_heritage_create")
     * @Template("ancestry/heritage/create.html.twig")
     */
    public function createAncestryHeritageAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(HeritageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $ancestry->addHeritage($heritage);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzictwo stworzone!');

            return $this->redirectToRoute('ancestry_show', ['id' => $ancestry->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry//{baseId}/heritage/{id}/edit", name="ancestry_heritage_edit")
     * @Template("ancestry/heritage/create.html.twig")
     */
    public function editAncestryHeritageAction(Request $request, int $baseId, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage = $entityManager->getRepository(Heritage::class)->find($id);

        $form = $this->createForm(HeritageType::class, $heritage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addFlash('success', 'Dziedzictwo zmienione!');

            return $this->redirectToRoute('ancestry_show', ['id' => $baseId]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}