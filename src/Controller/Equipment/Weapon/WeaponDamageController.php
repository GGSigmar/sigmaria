<?php

namespace App\Controller\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponDamage;
use App\Form\Equipment\Weapon\WeaponDamageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeaponDamageController extends AbstractController
{
    /**
     * @Route("/equipment/weapon/damage/list", name="list_weapon_damages")
     * @Template("equipment/weapon/damage/list.html.twig")
     */
    public function listWeaponDamagesAction() {
        $weaponDamages = $this->getDoctrine()->getRepository(WeaponDamage::class)
            ->findBy(['isActive' => true]);

        return [
            'weaponDamages' => $weaponDamages,
        ];
    }

    /**
     * @Route("/equipment/weapon/damage/create", name="create_weapon_damage")
     * @Template("equipment/weapon/damage/form.html.twig")
     */
    public function createWeaponDamageAction(Request $request) {
        $form = $this->createForm(WeaponDamageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponDamage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponDamage);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon damage created!');

            return $this->redirectToRoute('list_weapon_damages');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/damage/{id}/edit", name="edit_weapon_damage")
     * @Template("equipment/weapon/damage/form.html.twig")
     */
    public function editWeaponDamageAction(Request $request, WeaponDamage $weaponDamage) {
        $form = $this->createForm(WeaponDamageType::class, $weaponDamage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponDamage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponDamage);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon damage edited!');

            return $this->redirectToRoute('list_weapon_damages');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/damage/{id}/delete", name="delete_weapon_damage")
     */
    public function deleteWeaponDamageAction(WeaponDamage $weaponDamage) {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($weaponDamage);
        $entityManager->flush();

        $this->addFlash('success', 'Weapon damage deleted!');

        return $this->redirectToRoute('list_weapon_damages');
    }
}