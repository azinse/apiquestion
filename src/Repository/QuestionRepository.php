<?php

namespace App\Repository;

use App\Entity\Question;
use Symfony\Component\Config\FileLocator as FileLocator;

use Symfony\Component\Serializer\Serializer;
use Stichoza\GoogleTranslate\GoogleTranslate;


class QuestionRepository
{
    
    private $fileLocator;
    private $serializer;
    private $format;
    private  $datas;
    private $path;
    private $translator;

    public function __construct(FileLocator $fileLocator, Serializer $serializer, string $format = 'json', GoogleTranslate $translator)
    {
        
        $this->translator = $translator;
        $this->fileLocator = $fileLocator;
        
        $this->path = $this->fileLocator->locate('questions.'.$format);
        $this->serializer = $serializer;
        $this->format = $format;
       
        $this->datas = $serializer->deserialize(file_get_contents($this->path), 'App\Entity\Question[]', $format, []);
        
        return $this->datas;
    }
   
    
    public function getQuestions($lang){
        
        $this->translator->setTarget($lang);
        
        foreach($this->datas as $key => $d){
            $d->setText($this->translator->translate($d->getText()));
            foreach($d->getChoices() as $ch){
                $ch->setText($this->translator->translate($ch->getText()));
            }
            $this->datas[$key] = $d;
        }
        
        return $this->datas;
    }
    
    public function addQuestion(Question $question){
        $this->datas[] = $question;
        $questions = $this->serializer->serialize($this->datas, $this->format);
        file_put_contents($this->path, $questions);
    }
}
