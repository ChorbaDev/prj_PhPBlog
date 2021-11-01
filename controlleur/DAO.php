<?php

interface DAO
{
    public function create($object);
    public function update($aRemplacer,$par);
    public function delete($object);
}

 ?>
