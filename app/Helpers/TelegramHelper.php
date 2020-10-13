<?php


namespace App\Helpers;


use Illuminate\Notifications\Notifiable;

class TelegramHelper
{
    use Notifiable;

    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}
