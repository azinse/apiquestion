<?php

namespace App\Entity;

/**
 * Choice
 *
 */
class Choice
{
 
    private $text;

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
}
