<?php
require_once ('includes/pdo.php');
require_once 'clases/Conexion.php';
require_once 'clases/Producto.php';


$producto = new Producto();
function obtenerListaMarcas(){
  $db=Conexion::conectar();
  try {
    $sql = "SELECT id_marca,marca 
      FROM marcas";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $variable = $stmt->fetchAll(PDO::FETCH_ASSOC);//array asociado
    $stmt->closeCursor();
    return $variable;  
  } catch (\Exception $e) {
    echo "Error al obtener Lista de Marcas";
    $e->getMessage();
  }  
}
function obtenerListaCategorias(){
  $db=Conexion::conectar();

  try {
    $sql = "SELECT id_categoria,categoria
      FROM categorias";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $variable = $stmt->fetchAll(PDO::FETCH_ASSOC);//array asociado
    $stmt->closeCursor();
    return $variable;
  } catch (\Exception $e) {
    echo "Error al obtener Lista de Categorias";
    $e->getMessage();
  }
}
$variable=$producto->obtenerListaProductos($db);
//var_dump($variable);
if ($_POST) {
 // var_dump($_POST);
 // exit;
  if (isset($_POST["btnCargar"])) {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio= $_POST["precio"];
    $stock = $_POST["stock"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];
    $descuento = $_POST["descuento"];
    $img = "img/productos/phone.jpg";//$_POST["img"]; esto lo deje asi para que funciones pero tendria que ir la direccion

    $producto->altaProducto($img);
  }elseif (isset($_POST["btnBorrar"])) {
    $id = $_POST["id"];

    $producto->borrarProducto($id);
  }
  if (isset($_POST["modificar_id"])) {
    $id=2;//de alguna manera le tiene que llegar un id 
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio= $_POST["precio"];
    $stock = $_POST["stock"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];
    $descuento = $_POST["descuento"];
    $img = "img/productos/phone.jpg";
    $producto->modificarProducto($id,$nombre, $descripcion,$precio, $stock, $marca, $categoria, $descuento, $img);
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include 'includes/head.php';?>
<title>ABM Productos</title>

<body>

  <?php include 'includes/headerAdm.php'; ?>

  <main>
    
    <div class="container">
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Eliminar Productos
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <form class="borrarProducto" action="" method="post">
                <label for="id">Id del producto que se desea borrar</label>
                <br>
                <input type="number" min=1 name="id" value="">

                <button type="submit" name="btnBorrar" value="borrar">Borrar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h5 class="mb-0">
              <button class="btn btn-link mr-3 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Lista de Productos
              </button>
              <a href="agregarProducto.php" class="btn btn-primary ml-3">Agregar</a>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <ul class="list-group">
              <li class="list-group-item">
                <div class="card-body form-inline d-flex justify-content-between px-0">
                  <div class="form-group mb-1 col-1 px-1" >
                      <span  class="form-control-plaintext text-center">Id</span>
                  </div>
                  <div class="form-group mb-1 col-2 px-1" >
                      <span  class="form-control-plaintext text-center">Nombre</span>
                  </div>
                  <div class="form-group mb-1 col-1 px-1" >
                      <span  class="form-control-plaintext text-center">Descripcion</span>
                  </div>
                  <div class="form-group mb-1 col-1 " >
                      <span  class="form-control-plaintext text-center">Precio</span>
                  </div>
                  <div class="form-group mb-1 col-1 px-1" >
                      <span  class="form-control-plaintext text-center">Stock</span>
                  </div>
                  <div class="form-group mb-1 col-2 px-1" >
                      <span  class="form-control-plaintext text-center">Marca</span>
                  </div>
                  <div class="form-group mb-1 col-1 px-1" >
                      <span  class="form-control-plaintext text-center">Categoria</span>
                  </div>
                  <div class="form-group mb-1 col-1 px-1" >
                      <span  class="d-block form-control-plaintext text-center">Descuento</span>
                  </div>
                  <div class="form-group mb-1 col-2 px-1" >
                      <span  class="d-block text-center form-control-plaintext text-center">Imagen</span>
                  </div>
                </div>
              </li>
              <?php foreach ($variable as $key => $value) { ?>

                <li class="list-group-item">
                  <div class="card-body d-flex justify-content-between px-0">
                    <form class="form-inline" action="modificarProducto.php" method="post">
                      <div class="form-group mb-1 col-1 px-1" >
                        <input type="text" readonly class="form-control-plaintext text-center" id="id" value="<?=$value->getId();?>" name="id">
                      </div>
                      <div class="form-group mb-2 col-2 px-1">

                        <span  class="form-control-plaintext text-center" ><?=$value->getNombre();?></span>
                      </div>
                      <div class="form-group mb-2 col-1">

                        <span class="form-control-plaintext text-center" >
                          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter">
                            Ver
                          </button>
                        </span>
                      </div>
                      <!--modal de descripcion -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Descripcion</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                             <!-- <p>
                                <pre>
                                  <?=$value->getDescripcion();?>
                                </pre>
                              </p>
                              -->
                              <?php 
                                  $array=explode(PHP_EOL,$value->getDescripcion());
                                  foreach ($array as $key => $caracteristica) {?>
                                    <ul type="circle">
                                      <li >
                                        <?=$caracteristica;?>
                                      </li>
                                    </ul>
                                  <?php
                                  }
                                  ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--modal de descripcion -->
                      <div class="form-group mb-2 col-1">

                        <span class="form-control-plaintext text-center" >$ <?=$value->getPrecio();?></span>
                      </div>
                      <div class="form-group mb-2 col-1 px-1">

                        <span class="form-control-plaintext text-center" ><?=$value->getStock();?></span>
                      </div>
                      <div class="form-group mb-2 col-2 px-1">

                        <span class="form-control-plaintext text-center" ><?=$value->getMarca();?></span>
                      </div>
                      <div class="form-group mb-2 col-1 px-1">

                        <span class="form-control-plaintext text-centerd-block" ><?=$value->getCategoria();?></span>
                      </div>
                      <div class="form-group mb-2 col-1 px-1">

                        <span class="form-control-plaintext text-center d-block" ><?=$value->getDescuento();?>%</span>
                      </div>
                      <div class="form-group mb-2 col-2 text-center">

                        <img src="<?=$value->getImg();?>" alt="" sizes="" width="80%">
                      </div>
                      <div class="form-group mb-2 col-12 text-center">
                        <button type="submit" class="btn btn-primary mx-2 mb-1 " name="modificar_l" value="<?=$value->getId();?>">Modificar</button>
                        <button type="submit" class="btn btn-primary mx-2 mb-1 " name="eliminar_l" value="<?=$value->getId();?>">Eliminar</button>
                      </div>
                    </form>
                  </div>
                </li>

              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </main>

  <?php
  include 'includes/footer.php';
  include 'includes/scriptBootstrap.php';
  ?>

</body>
</html>
