<?php

// src/AppBundle/Service/FileUploader.php


namespace AppBundle\Service;


class FileUploader
{
    private $targetDir;
    private $filename;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }


    public function upload($file)
    {

        // Prévoir des vérifications sur le fichier
        // $file['error']['image'] pour les erreurs
        // $file['size']['image'] pour la taille du fichier
        // $file['type']['image'] pour le type du fichier

        // On récupère le fichier dans le dossier temporaire
        $tmp_name = $file['tmp_name']['image'];


        // On récupère l'extension du fichier
        $extension = explode('.',$file['name']['image']);
        $extension = end($extension);


        // On génère un nom unique pour le fichier et on ajoute son extension
        $this->setFileName(md5(uniqid()).'.'.$extension);

        // On déplace le fichier avec son nouveau nom dans le dossier symfony
        $upload = move_uploaded_file($tmp_name, $this->getTargetDir() . '/' . $this->getFileName());


        return $upload;


    }


    public function getTargetDir()
    {
        return $this->targetDir;
    }


    public function getFileName()
    {
        return $this->filename;
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

}
