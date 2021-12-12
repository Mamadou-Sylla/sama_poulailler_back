<?php


namespace App\Services;

use App\Entity\Profil;
use App\Entity\User;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Validator\ValidatorInterface;




class HelperService
{
    private $serializer;
    private $validator;
    private $encoder;
    private $manager;
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, 
    UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager,
    ProfilRepository $repoProfil, UserRepository $repoUser){
        $this->serializer=$serializer;
        $this->validator=$validator;
        $this->encoder=$encoder;
        $this->manager=$manager;
        $this->repoProfil=$repoProfil;
        $this->repoUser=$repoUser;
    }
    public function PostUser(Request $request){

        $post_user = $request->request->all();
        // dd($post_user['profil']);
        $photo=$request->files->get("photo");
        $photo=fopen($photo->getRealPath(),"rb");
        //$post_user=json_encode($post_user); 
        $id_profil = $post_user['profil_id'];
        $id_profil = explode('/', $id_profil);
        $profils=$this->repoProfil->find($id_profil[2]);
        // dd($profils);
        $profil=$profils->getLibelle();
        // dd($profil);
        if ($profil == "ADMIN") {
            # code...
            $newProfil = "User";
            $class="App\Entity\\$newProfil";
        }
        elseif ($profil == "EMPLOYE") {
            # code...
            $newProfil = "Employe";
            $class="App\Entity\\$newProfil";
        }
        // dd($post_user);

        $user= $this->serializer->denormalize($post_user, $class, 'json');
        $user->setProfil($profils);
        // dd($user);
        $errors = $this->validator->validate($user);
         if ($errors) {
             $errorsString =$this->serializer->serialize($errors,'json');
             return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
         }
        $password = $user->getPassword();
        // dd($password);
        $user=$user->setPassword($this->encoder->encodePassword($user, $password));
        // dd($user);
        $user->setPhoto($photo);
        // dd($user);
        $this->manager->persist($user);
        $this->manager->flush();
        fclose($photo);
        return $user;
    }




    public function EditUser(Request $request)
    {
        $id = $request->get('id');
        $edit_user = $request->request->all();
        $photo=$request->files->get("photo");
        $photo=fopen($photo->getRealPath(),"rb");
        $id_profil = $edit_user['profil_id'];
        $id_profil = explode('/', $id_profil);
        $profils=$this->repoProfil->find($id_profil[2]);
        // dd($profils);
        $profil=$profils->getLibelle();
        // dd($profil);
        if ($profil == "ADMIN") {
            # code...
            $newProfil = "User";
            $class="App\Entity\\$newProfil";
        }
        elseif ($profil == "EMPLOYE") {
            # code...
            $newProfil = "Employe";
            $class="App\Entity\\$newProfil";
        }
        // dd($post_user);

        $user= $this->serializer->denormalize($edit_user, $class, 'json');
        $user->setProfil($profils);
        // dd($user);
        $errors = $this->validator->validate($user);
         if ($errors) {
             $errorsString =$this->serializer->serialize($errors,'json');
             return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
         }
        $password = $user->getPassword();
        // dd($password);
        $user=$user->setPassword($this->encoder->encodePassword($user, $password));
        // dd($user);
        $user->setPhoto($photo);
        //  dd($user);
        // $this->manager->persist($user);
        $this->manager->flush();
        fclose($photo);
        return $user;


    }

}
