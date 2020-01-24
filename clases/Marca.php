<?php

/**
*
*/
class Marca
{

<<<<<<< HEAD
  function __construct(argument)
  {
    // code...
  }

=======
>>>>>>> 35de5664e2c3b65f696137834099d6e6b4892312
  private $id;
  private $marca;


  /**
  * Get the value of Id
  *
  * @return mixed
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set the value of Id
  *
  * @param mixed $id
  *
  * @return self
  */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
  * Get the value of Marca
  *
  * @return mixed
  */
  public function getMarca()
  {
    return $this->marca;
  }

  /**
  * Set the value of Marca
  *
  * @param mixed $marca
  *
  * @return self
  */
  public function setMarca($marca)
  {
    $this->marca = $marca;

    return $this;
  }

}

?>
