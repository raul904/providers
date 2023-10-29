<?php

namespace App\Controller;

use App\DTO\ProviderDTO;
use App\Entity\Provider;
use App\Entity\ProviderType;
use App\Form\ProviderTypeForm;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $providers = $entityManager->getRepository(Provider::class)->findAll();

        return $this->render('index.html.twig',
            [
                "providers" => $providers
            ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $providerDTO = new ProviderDTO();

        $form = $this->createForm(ProviderTypeForm::class, $providerDTO);
        $entityManager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ProviderDTO $providerDTO */
            $providerDTO = $form->getData();

            $providerType = $entityManager->getRepository(ProviderType::class)->find($providerDTO->getProviderTypeId());
            $provider = (new Provider())
                ->setId($providerDTO->getProviderId())
                ->setName($providerDTO->getProviderName())
                ->setEmail($providerDTO->getEmail())
                ->setPhoneNumber($providerDTO->getPhoneNumber())
                ->setActive($providerDTO->isActive())
                ->setProviderType($providerType)
                ->setDateCreated((new DateTime()))
                ->setDateUpdated((new DateTime()));

            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirect('/providers');
        }

        $providerTypes = $entityManager->getRepository(ProviderType::class)->findAll();
        $providerTypesSelect = [];
        foreach ($providerTypes as $providerType){
            $providerTypesSelect[$providerType->getId()] = $providerType->getName();
        }

        return $this->render('form/providerForm.html.twig',
            [
                "form" => $form->createView(),
                "selectProviderTypes" =>  $providerTypesSelect
            ]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $providerId = $request->get('id');
        $provider = $entityManager->getRepository(Provider::class)->find($providerId);

        $entityManager->remove($provider);
        $entityManager->flush();

        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Request $request)
    {
        $providerDTO = new ProviderDTO();
        $entityManager = $this->getDoctrine()->getManager();
        $providerId = $request->get('id');
        $provider = $entityManager->getRepository(Provider::class)->find($providerId);

        $providerDTO
            ->setProviderName($provider->getName())
            ->setProviderId($provider->getId())
            ->setEmail($provider->getEmail())
            ->setProviderTypeId($provider->getProviderType()->getId())
            ->setPhoneNumber($provider->getPhoneNumber())
            ->setActive($provider->getActive())
            ->setDateCreated($provider->getDateCreated())
            ->setDateUpdated($provider->getDateUpdated());
        $form = $this->createForm(ProviderTypeForm::class, $providerDTO);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ProviderDTO $providerDTO */
            $providerDTO = $form->getData();

            $providerType = $entityManager->getRepository(ProviderType::class)->find($providerDTO->getProviderTypeId());
            $provider
                ->setId($providerDTO->getProviderId())
                ->setName($providerDTO->getProviderName())
                ->setEmail($providerDTO->getEmail())
                ->setPhoneNumber($providerDTO->getPhoneNumber())
                ->setActive($providerDTO->isActive())
                ->setProviderType($providerType)
                ->setDateUpdated((new DateTime()));

            $entityManager->persist($provider);
            $entityManager->flush();


            return $this->redirect('/providers');
        }

        $providerTypes = $entityManager->getRepository(ProviderType::class)->findAll();
        $providerTypesSelect = [];
        foreach ($providerTypes as $providerType) {
            $providerTypesSelect[$providerType->getId()] = $providerType->getName();
        }

        return $this->render('form/providerForm.html.twig',
            [
                "form" => $form->createView(),
                "selectProviderTypes" => $providerTypesSelect
            ]);

    }

}