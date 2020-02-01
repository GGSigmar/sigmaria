<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Language;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends BaseController
{
    /**
     * @Route("/setting/language/list", name="language_list")
     * @Template("setting/language/list.html.twig")
     */
    public function listLanguagesAction()
    {
        $languages = $this->getDoctrine()->getRepository(Language::class)->findAll();

        $templateData = [
            'languages' => $languages,
            'entityName' => 'language',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }

    /**
     * @Route("/setting/language/{id}/show", name="language_show")
     * @Template("setting/language/show.html.twig")
     */
    public function showLanguageAction(Language $language)
    {
        $this->denyAccessUnlessGranted('view', $language);

        $templateData = [
            'language' => $language,
            'entityName' => 'language',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}