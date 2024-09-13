<?php
namespace App\Exceptions;

use Exception;

class EntityNotFoundException extends Exception
{
    public function __construct($id = null)
    {
        $this->message = is_null($id) ? "Não existe registro" : "Não existe registro com o código $id";
    }
}
