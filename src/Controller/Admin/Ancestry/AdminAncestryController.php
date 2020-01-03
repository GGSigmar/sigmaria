<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use App\Form\Ancestry\AncestryType;
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

            $this->addFlash('success', 'Rasa stworzona!');

            return $this->redirectToRoute('ancestry_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'ancestry'
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/edit", name="ancestry_edit")
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

        $this->addFlash('success', 'Rasa zabita!');

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

        $this->addFlash('success', 'Rasa usunięta!');

        return $this->redirectToRoute('ancestry_list');
    }
}