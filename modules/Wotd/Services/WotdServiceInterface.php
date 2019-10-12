<?php
namespace Wotd\Services;

interface WotdServiceInterface
{
    public function getWordOfTheDay();

    public function getAllWords();
}
