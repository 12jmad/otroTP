<?php
/**
*
*/
class Producto
{
  private $id;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $marca;
  private $categoria;
  private $descuento;
  private $img;

  public function altaProducto(string $img)
  {
    $db=Conexion::conectar();
    $nombre = $_POST["nombre"];
    $desc = $_POST["descripcion"];
    $precio= $_POST["precio"];
    $stock = $_POST["stock"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];
    $descuento = $_POST["descuento"];
    try{
    $statement = $db->prepare("INSERT into productos(id_marca,id_categoria,nombre,descripcion,precio,cantidad,img,descuento) VALUES ( :idMarca, :idCategoria,:nombre, :descripcion, :precio, :cantidad, :img,:descuento)");

    $statement->bindValue(':idMarca', $marca,PDO::PARAM_INT);
    $statement->bindValue(":idCategoria", $categoria,PDO::PARAM_INT);
    $statement->bindValue(":nombre", $nombre,PDO::PARAM_STR);
    $statement->bindValue(":descripcion", $desc,PDO::PARAM_STR);
    $statement->bindValue(":precio", $precio);
    $statement->bindValue(":cantidad", $stock,PDO::PARAM_INT);
    $statement->bindValue(":img", $img,PDO::PARAM_STR);
    $statement->bindValue(":descuento", $descuento);

    $statement->execute();
    $statement->closeCursor();
    }catch (\Exception $e)
      {
        echo "Error al cargar poducto";
        $e->getMessage();
      }
    
 
  }

  public function modificarProducto(int $id,string $nombre, string $desc,float $precio,int $stock, int $marca, int $categoria, float $descuento, string $img)
  {
    $db=Conexion::conectar();
    try{
      $sql="UPDATE productos SET nombre=':nombre',descripcion=':descripcion',precio=:precio,cantidad=:cantidad,img=':img',descuento=:descuento,id_marca=:idMarca,id_categoria=:idCategoria WHERE id_producto = :id";
      $statement = $db->prepare($sql);
      $statement->bindValue(':id', $id,PDO::PARAM_INT);
      $statement->bindValue(':idMarca', $marca,PDO::PARAM_INT);
      $statement->bindValue(":idCategoria", $categoria,PDO::PARAM_INT);
      $statement->bindValue(":nombre", $nombre,PDO::PARAM_STR);
      $statement->bindValue(":descripcion", $desc,PDO::PARAM_STR);
      $statement->bindValue(":precio", $precio);
      $statement->bindValue(":cantidad", $stock,PDO::PARAM_INT);
      $statement->bindValue(":img", $img,PDO::PARAM_STR);
      $statement->bindValue(":descuento", $descuento);
  
      $statement->execute();
      $statement->closeCursor();
      }catch (\Exception $e)
        {
          echo "Error al modificar poducto";
          $e->getMessage();
        }
  }

  public function borrarProducto($id)
  {
    $db=Conexion::conectar();
    try
    {

      $statement = $db->prepare("DELETE FROM productos WHERE id_producto = :id");

      $statement->bindValue(":id", $id);

      $statement->execute();

    }
    catch (\Exception $e)
    {
        echo "Error al borrar producto";
        $e->getMessage();
    }

  }
  public function buscarPorId(int $id){
    $db=Conexion::conectar();
    if(isset($_POST["id"])){
      $id=(int)$_POST["id"];  
    }
    try {
      $sql = "SELECT id_producto as id,nombre,descripcion,precio,cantidad as stock,marca,categoria,descuento,img 
        FROM productos as p
          inner join categorias as c on p.id_categoria=c.id_categoria
          inner join marcas as m on p.id_marca=m.id_marca WHERE id_producto= :id";
      $seleccionado=$db->prepare($sql);
      $seleccionado->bindValue(":id", $id,PDO::PARAM_INT);
      $seleccionado->execute();
      $variable = $seleccionado->fetchObject("Producto");//objeto
      return $variable;
    } catch (\Exception $e) {
      $e->getMessage();
      return false;
    }
  }
  public function obtenerListaProductos(){
    $db=Conexion::conectar();
    try {
      $sql = "SELECT id_producto as id,nombre,descripcion,precio,cantidad as stock,marca,categoria,descuento,img 
        FROM productos as p
          inner join categorias as c on p.id_categoria=c.id_categoria
          inner join marcas as m on p.id_marca=m.id_marca";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      //$variable = $stmt->fetchAll(PDO::FETCH_ASSOC);//array asociado
      $variable = $stmt->fetchAll(PDO::FETCH_CLASS,"Producto");//objeto
      $stmt->closeCursor();
      return $variable;  
    } catch (\Exception $e) {
      echo "Error al obtener Lista de Productos";
      $e->getMessage();
      return false;
    }
    
  }


  /**
   * Get the value of id
   */ 
  public function getId():int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nombre
   */ 
  public function getNombre():string
  {
    return $this->nombre;
  }

  /**
   * Set the value of nombre
   *
   * @return  self
   */ 
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;

    return $this;
  }

  /**
   * Get the value of descripcion
   */ 
  public function getDescripcion():string
  {
    return $this->descripcion;
  }

  /**
   * Set the value of descripcion
   *
   * @return  self
   */ 
  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;

    return $this;
  }

  /**
   * Get the value of stock
   */ 
  public function getStock():int
  {
    return $this->stock;
  }

  /**
   * Set the value of stock
   *
   * @return  self
   */ 
  public function setStock($stock)
  {
    $this->stock = $stock;

    return $this;
  }

  /**
   * Get the value of marca
   */ 
  public function getMarca():string
  {
    return $this->marca;
  }

  /**
   * Set the value of marca
   *
   * @return  self
   */ 
  public function setMarca($marca)
  {
    $this->marca = $marca;

    return $this;
  }

  /**
   * Get the value of categoria
   */ 
  public function getCategoria():string
  {
    return $this->categoria;
  }

  /**
   * Set the value of categoria
   *
   * @return  self
   */ 
  public function setCategoria($categoria)
  {
    $this->categoria = $categoria;

    return $this;
  }

  /**
   * Get the value of descuento
   */ 
  public function getDescuento():float
  {
    return $this->descuento;
  }

  /**
   * Set the value of descuento
   *
   * @return  self
   */ 
  public function setDescuento($descuento)
  {
    $this->descuento = $descuento;

    return $this;
  }

  /**
   * Get the value of img
   */ 
  public function getImg():string
  {
    return $this->img;
  }

  /**
   * Set the value of img
   *
   * @return  self
   */ 
  public function setImg($img)
  {
    $this->img = $img;

    return $this;
  }

  /**
   * Get the value of precio
   */ 
  public function getPrecio():float
  {
    return $this->precio;
  }

  /**
   * Set the value of precio
   *
   * @return  self
   */ 
  public function setPrecio($precio)
  {
    $this->precio = $precio;

    return $this;
  }
}

?>
