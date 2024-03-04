<?php

namespace App\Service;

use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
class UserService{

    private $passwordManager;

    public function __construct(UserPasswordHasherInterface  $passwordManager)
    {
        $this->passwordManager = $passwordManager;
    }

    public function getRandomizeUser() : Cliente{
        $cliente = new Cliente();
        $cliente->setNombre((new AsciiSlugger())->slug(uniqid('', true)));
        $cliente->setApellidos((new AsciiSlugger())->slug(uniqid('', true)));
        $cliente->setEmail((new AsciiSlugger())->slug(uniqid('', true)).'@example.com');
        $cliente->setContrasena($this->passwordManager->hashPassword($cliente, 'test')); 
        return $cliente;
    }

    public function login(
        array $post, 
        EntityManagerInterface $entityManagerInterface
        ) : string | Cliente{
       if(!array_key_exists('contrasena', $post) && !array_key_exists('email', $post)){
          return 'Error no se ha mandado email ni contraseña';
       }
       if(!array_key_exists('email', $post)){
          return 'Error no se ha mandado email';   
       }
       if(!array_key_exists('contrasena', $post)){
          return 'Error no se ha manadado una contraseña';
       } 
       $repository = $entityManagerInterface->getRepository(Cliente::class);
       $user = $repository->findBy(['email'=>$post['email']]);
       if (empty($user)) {
          return 'El usuario buscado no existe';
       }
       if(!empty($user) && $this->passwordManager->isPasswordValid($user[0], $post['contrasena'])){
          return $user[0];
       }
       return 'Usuario o contraseña no es correcta';
    }



    /**
     * Cuestiones que quedan: 
     *  1º Encontrar al usuario por mail
     *  2º Añadir en el entity que es unico
     *  3º Añadir usuarios según un excel
     *  4º Validar la contraseña     * 
     */
}

?>