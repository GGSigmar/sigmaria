<?php

namespace App\Controller\Ancestry;

use App\Controller\Core\CoreController;
use App\Entity\Ancestry\Ancestry;
use App\Form\Ancestry\AncestryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AncestryController extends CoreController
{
    /**
     * @Route("/ancestry/list", name="list_ancestries")
     * @Template("ancestry/ancestry/list.html.twig")
     */
    public function listAncestriesAction()
    {
        $ancestries = $this->getDoctrine()->getRepository(Ancestry::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'ancestries' => $ancestries,
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/{id}/show", name="show_ancestry")
     * @Template("ancestry/ancestry/show.html.twig")
     */
    public function showAncestryAction(Ancestry $ancestry)
    {
        $templateData = [
            'ancestry' => $ancestry,
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/create", name="create_ancestry")
     * @Template("ancestry/ancestry/form.html.twig")
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

            $this->addFlash('success', 'Ancestry created!');

            return $this->redirectToRoute('list_ancestries');
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/{id}/edit", name="edit_ancestry")
     * @Template("ancestry/ancestry/form.html.twig")
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

            $this->addFlash('success', 'Ancestry edited!');

            return $this->redirectToRoute('show_ancestry', ['id' => $ancestry->getId()]);
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/{id}/delete", name="delete_ancestry")
     */
    public function deleteAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($ancestry);
        $entityManager->flush();

        $this->addFlash('success', 'Ancestry deleted!');

        return $this->redirectToRoute('list_ancestries');
    }

}