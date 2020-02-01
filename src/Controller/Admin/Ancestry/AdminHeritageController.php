<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Heritage;
use App\Form\Ancestry\HeritageType;
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
            'entityName' => 'heritage',
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
            'entityName' => 'heritage'
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
            'entityName' => 'heritage'
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/kill", name="heritage_kill")
     */
    public function killWeaponPropertyAction(Heritage $heritage)
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
    public function reviveWeaponPropertyAction(Heritage $heritage)
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
    public function deleteWeaponPropertyAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($heritage);
        $entityManager->flush();

        $this->addFlash('danger', 'Dziedzictwo usunięte!');

        return $this->redirectToRoute('heritage_list');
    }
}