<?php

namespace App\Controller;

use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EstaunController extends AbstractController
{

    #[Route('/estaun', name: 'app_estaun')]
    public function index(): JsonResponse
    {
        return $this->json([
            'status' => 200,
            'message' => 'Estás en el controller de la app',
        ]);
    }

    #[Route('/randomuser', name:"customer_login", methods:['POST', 'OPTIONS'])]
    public function random(
        EntityManagerInterface $entityManagerInterface, 
        UserService $user
        ){
            
        $cliente = $user->getRandomizeUser();
        $entityManagerInterface->persist($cliente);
        $entityManagerInterface->flush();
        return $this->json([
            'status' => 200,
            'data'=>(array)$cliente]);
    }

    #[Route('/customerlogin', methods:['POST'])]
    public function customerlogin(
        EntityManagerInterface $entityManagerInterface, 
        Request $request,
        UserService $user
        ):JsonResponse{
        $login = $user->login($request->request->all(), $entityManagerInterface);
        if(gettype($login)==='object'){
            $login = [
                'nombre' => $login->getNombre(),
                'apellidos' => $login->getApellidos(),
                'email' => $login->getEmail()
            ];
        }
        return $this->json([
            'status' => 200,
            'response' => $login 
        ]);
    }

    #[Route('/addbooking', methods:['POST'])]
    public function addbooking(EntityManagerInterface $entityManagerInterface, Request $request){

    }

    #[Route('/deletebooking/{id}', methods:['POST'])]
    public function deletebooking(EntityManagerInterface $entityManagerInterface, Request $request, int $id){
        return $this->json([
            'status' => 200,
            'response' => $id
        ]);
    }

    #[Route('/getbooking/{date}', methods:['GET'])]
    public function getbookings(EntityManagerInterface $entityManagerInterface, Request $request, string $date){
        return $this->json([
            'status' => 200,
            'response' => $date
        ]);
    }

    #[Route('/massiveimport', methods:['POST'])]
    public function massiveimport(EntityManagerInterface $entityManagerInterface, Request $request){

    }
}
