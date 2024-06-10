<?php

namespace Project\Impossible\Controllers;

class PostController
{
    public function show($id)
    {
        return "Displaying post with ID: $id";
    }public function rest(){
        return "hooo Rest";
    }
    public static function staticShow($id)
    {
        return "Displaying post statically with ID: $id";
    }
}
