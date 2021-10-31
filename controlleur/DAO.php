<?php

interface DAO
{
    public function create($object);
    public function update($object);
    public function delete($object);
    public function getByID($id);
}

 ?>
