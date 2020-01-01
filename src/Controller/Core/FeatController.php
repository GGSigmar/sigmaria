<?php

namespace App\Controller\Core;

use App\Entity\Core\Feat;
use App\Form\Core\FeatType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class FeatController extends CoreController
{
    /**
     * @Route("/core/feat/list", name="list_feats")
     * @Template("core/feat/list.html.twig")
     */
    public function listFeatsAction()
    {
        $feats = $this->getDoctrine()->getRepository(Feat::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'feats' => $feats,
            'entityName' => 'feat',
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/core/feat/{id}/show", name="show_feat")
     * @Template("core/feat/show.html.twig")
     */
    public function showFeatAction(Feat $feat)
    {
        $templateData = [
            'feat' => $feat,
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/core/feat/create", name="create_feat")
     * @Template("core/feat/form.html.twig")
     */
    public function createFeatAction(Request $request)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut stworzony!');

            return $this->redirectToRoute('list_feats');
        }

        $templateData = [
            'form' => $form->createView(),
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/core/feat/{id}/edit", name="edit_feat")
     * @Template("core/feat/form.html.twig")
     */
    public function editFeatAction(Request $request, Feat $feat)
    {
        $form = $this->createForm(FeatType::class, $feat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut zmieniony!');

            return $this->redirectToRoute('list_feats');
        }

        $templateData = [
            'form' => $form->createView(),
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/core/feat/{id}/delete", name="delete_feat")
     */
    public function deleteFeatAction(Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat->setIsActive(false);

        $entityManager->persist($feat);
        $entityManager->flush();

        $this->addFlash('success', 'Atut usunięty!');

        return $this->redirectToRoute('list_feats');
    }
}