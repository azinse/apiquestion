<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Question
 *
 */
class Question
{
 
    private $text;

    private $createdAt;

    private $choices;

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

	/**
     * Get text
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }


    /**
     * Set createdAt
     *
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt(): ? string
    {
        return $this->createdAt;
    }
    
    /**
     * Set choices
     *
     * @param Choice[] $choices
     */
    public function setChoices($choices): void
    {
        $this->choices = $choices;
    }

    /**
     * Get choices
     *
     * @return Choice[]
     */
    public function getChoices(): ? array 
    {
        return $this->choices;
    }
    
}
