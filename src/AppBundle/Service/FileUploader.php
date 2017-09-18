<?php

// src/AppBundle/Service/FileUploader.php


namespace AppBundle\Service;


class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }


    public function upload($file)
    {

        // Prévoir des vérifications sur le fichier
        // $file['error']['image'] pour les erreurs

        // On récupère le fichier dans le dossier temporaire
        $tmp_name = $file['tmp_name']['image'];


        // On récupère l'extension du fichier
        $extension = explode('.',$file['name']['image']);
        $extension = end($extension);


        // On génère un nom unique pour le fichier et on ajoute son extension
        $filename = md5(uniqid()).'.'.$extension;

        // On déplace le fichier avec son nouveau nom dans le dossier symfony
        $upload = move_uploaded_file($tmp_name, $this->getTargetDir() . '/' . $filename);


        return $upload;


    }


    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
