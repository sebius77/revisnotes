<?php

// src/AppBundle/Service/FileUploader.php

namespace AppBundle\Service;

class FileUploader
{
    private $targetDir;
    private $filename;

    const TAILLE_MAX_IMAGE = "400000";

    const MAUVAIS_TYPE_IMAGE = 1;
    const TAILLE_IMAGE_DEPASSEE = 2;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload($file)
    {

        // Prévoir des vérifications sur le fichier
        // $file['error']['image'] pour les erreurs
        // $file['size']['image'] pour la taille du fichier
        if ($file['size']['image'] > self::TAILLE_MAX_IMAGE) {
            return $upload = self::TAILLE_IMAGE_DEPASSEE;
        }

        // $file['type']['image'] pour le type du fichier
        if ($file['type']['image'] != 'image/jpeg') {
            return $upload = self::MAUVAIS_TYPE_IMAGE;
        }

        // On récupère le fichier dans le dossier temporaire
        $tmp_name = $file['tmp_name']['image'];

        // On récupère l'extension du fichier
        $extension = explode('.', $file['name']['image']);
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
