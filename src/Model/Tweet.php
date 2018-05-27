<?php
namespace App\Model;

class Tweet {
    private $text;
    private $date;

    public function __construct($text, $date)
    {
        $this->text = $text;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


}