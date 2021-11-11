<?php

interface dao
{
    public function create($object);
    public function update($aRemplacer,$par);
    public function delete($object);
}

 ?>
