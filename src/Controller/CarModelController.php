<?php

namespace App\Controller;

use App\Entity\CarModel;
use App\Form\CarModelType;
use App\Repository\CarModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/car/model')]
//#[IsGranted('ROLE_ADMIN')]
class CarModelController extends AbstractController
{
    #[Route('/', name: 'app_car_model_index', methods: ['GET'])]
    public function index(CarModelRepository $carModelRepository): Response
    {
        return $this->render('car_model/index.html.twig', [
            'car_models' => $carModelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_car_model_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarModelRepository $carModelRepository): Response
    {
        $carModel = new CarModel();
        $form = $this->createForm(CarModelType::class, $carModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carModelRepository->save($carModel, true);

            return $this->redirectToRoute('app_car_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car_model/new.html.twig', [
            'car_model' => $carModel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_model_show', methods: ['GET'])]
    public function show(CarModel $carModel): Response
    {
        return $this->render('car_model/show.html.twig', [
            'car_model' => $carModel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_model_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarModel $carModel, CarModelRepository $carModelRepository): Response
    {
        $form = $this->createForm(CarModelType::class, $carModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carModelRepository->save($carModel, true);

            return $this->redirectToRoute('app_car_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car_model/edit.html.twig', [
            'car_model' => $carModel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_model_delete', methods: ['POST'])]
    public function delete(Request $request, CarModel $carModel, CarModelRepository $carModelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carModel->getId(), $request->request->get('_token'))) {
            $carModelRepository->remove($carModel, true);
        }

        return $this->redirectToRoute('app_car_model_index', [], Response::HTTP_SEE_OTHER);
    }
}
