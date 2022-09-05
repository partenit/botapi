<?php


namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ActionRequest extends BaseRequest
{
    #[NotBlank()]
    protected $chat;
}