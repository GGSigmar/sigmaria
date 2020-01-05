<?php

namespace App\Controller\Admin\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Script;
use App\Form\Setting\ScriptType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminScriptController extends BaseController
{
    /**
     * @Route("/admin/setting/script/list", name="script_list")
     * @Template("setting/script/list.html.twig")
     */
    public function listScriptsAction()
    {
        $scripts = $this->getDoctrine()->getRepository(\App\Entity\Setting\Script::class)->findAll();

        $templateData = [
            'scripts' => $scripts,
            'entityName' => 'script',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/script/create", name="script_create")
     * @Template("setting/script/create.html.twig")
     */
    public function createScriptAction(Request $request)
    {
        $form = $this->createForm(ScriptType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $script = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($script);
            $entityManager->flush();

            $this->addFlash('success', 'Pismo stworzone!');

            return $this->redirectToRoute('script_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'script',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/script/{id}/edit", name="script_edit")
     * @Template("setting/script/edit.html.twig")
     */
    public function editScriptAction(Request $request, Script $script)
    {
        $form = $this->createForm(ScriptType::class, $script);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $script = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($script);
            $entityManager->flush();

            $this->addFlash('success', 'Pismo zmienione!');

            return $this->redirectToRoute('script_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'script',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/script/{id}/kill", name="script_kill")
     */
    public function killScriptAction(Script $script)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $script->setIsActive(false);

        $entityManager->persist($script);
        $entityManager->flush();

        $this->addFlash('warning', 'Pismo zabite!');

        return $this->redirectToRoute('script_list');
    }

    /**
     * @Route("/admin/setting/script/{id}/revive", name="script_revive")
     */
    public function reviveScriptAction(Script $script)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $script->setIsActive(true);

        $entityManager->persist($script);
        $entityManager->flush();

        $this->addFlash('success', 'Pismo wskrzeszone!');

        return $this->redirectToRoute('script_list');
    }

    /**
     * @Route("/admin/setting/script/{id}/delete", name="script_delete")
     */
    public function deleteScriptAction(Script $script)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($script);
        $entityManager->flush();

        $this->addFlash('danger', 'Pismo usunięte!');

        return $this->redirectToRoute('script_list');
    }
}