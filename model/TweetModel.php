<?php

class Tweet
{
    private $id;
    private $text;

    public function __construct($id, $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function removeEmojis()
    {
        $this->text = preg_replace(EMOJI_PATTERN, '', $this->text);
    }

    public function removeHashtags()
    {
        $this->text = preg_replace(HASHTAG_PATTERN, '', $this->text);
    }

    public function removeNonArabicLetters()
    {
        $this->text = preg_replace('/[^\x{0600}-\x{06FF}]/u', '', $this->text);
    }

    public function __toString()
    {
        return "Tweet " . $this->id . ": " . $this->text;
    }
}
