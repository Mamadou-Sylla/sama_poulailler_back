<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Formateur;
use App\Service\UserService;
use App\Services\HelperService;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    /**
     * @Route(
     * name="delete_user",
     * path="api/users/{id}",
     * methods={"DELETE"}
     * )
     */
    public function DeleteUser(UserRepository $repo, EntityManagerInterface $manager, Request $request): Response
    {
        $id = $request->get('id');
        $user = $repo->findOneBy(['id' => $id]);
        if ($user) {
            # code...
            $user->setIsDeleted(true);
            $manager->persist($user);
            $poulaillers=$user->getPoulailler();
            if($poulaillers)
            {
                foreach ($poulaillers as $poulailler){
                    $archived=$poulaillers->setArchived(true);
                    $manager->persist($archived);
                }
            }
            $manager->flush();
            return new JsonResponse("User bloque avec succes",Response::HTTP_OK);
        }
        else
        {
            return new JsonResponse("User n'existe pas",Response::HTTP_OK);
        }
       
    }
   


    /**
     * @Route(
     * name="post_user",
     * path="api/users",
     * methods={"POST"}
     * )
     */



    public function AddUser(Request $request, HelperService $helper, SerializerInterface $serializer): Response
    {
       
       $data= new User();
        $helper->PostUser($request, $data);
        return new JsonResponse("vous avez ajouter un user succes",Response::HTTP_CREATED);
    }

    /**
     * @Route(
     *   name="edit_user",
     *   path="api/users/{id}",
     *   methods={"POST"}
     *     )
     */

    public function UpdateUser(HelperService $helper, Request $request, UserRepository $repo)
    {
        // $user= new User();
        $id = $request->get('id');
        $data = $repo->findOneBy(['id' => $id]);
        // $edit_user = $request->request->all();
        // dd($edit_user);
        $helper->EditUser($request, $data);
            return new JsonResponse("vous avez modifier l'utilisateur avec succes",Response::HTTP_CREATED);
        // if($data)
        // {
        //     $helper->EditUser($request, $user);
        //     return new JsonResponse("vous avez modifier l'utilisateur avec succes",Response::HTTP_CREATED);
        // }
        // else
        // {
        //     return new JsonResponse("L'utilisateur n'existe pas",Response::HTTP_CREATED);
        // }
    }
}

