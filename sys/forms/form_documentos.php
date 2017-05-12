<!DOCTYPE html>
<html lang="en">

<body>

<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alta Documentos
                </div>
                <div class="panel-body">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select style="width: 300px;"  class="form-control" id="categoria" name="categoria">
                            <option value="">SELECCIONE UNA CATEGORIA</option>
                            <option <?php echo ($result->categoria=='Contabilidad')?"selected":""; ?> value="Contabilidad">CONTABILIDAD</option>
                            <option <?php echo ($result->categoria=='Novedades')?"selected":""; ?>  value="Novedades">NOVEDADES</option>
                            <option <?php echo ($result->categoria=='Laboral')?"selected":""; ?>  value="Laboral">LABORAL</option>
                            <option <?php echo ($result->categoria=='Publicaciones')?"selected":""; ?>  value="Publicaciones">PUBLICACIONES</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input class="form-control"  value="<?php echo (isset($result->descripcion))?$result->descripcion:""; ?>" name="descripcion" id="descripcion" placeholder="Ingrese Descripcion">
                    </div>
                    <div class="form-group">
                        <label>Ruta</label>
                        <input class="form-control"  value="<?php echo (isset($result->ruta))?$result->ruta:""; ?>" name="ruta" id="ruta" placeholder="Ingrese URL">
                    </div>
                    <div class="form-group">
                        <label>Archivo</label>
                        <div id="div_archivo">
                        <?php 
                        if(isset($result->id_registro)){
                            if (file_exists("../documentos/".$result->archivo_nombre)) { 
                            ?>
                                <input type="file" id="file_doc" name="file_doc">
                                 <?php if($result->archivo_extension=='application/pdf'){ ?>
                            <img style="cursor: pointer;"  class="img-circle" src="img/pdf.png" alt="service 3">
                            <?php } ?>
                            <?php if($result->archivo_extension=='application/msword'  || $result->archivo_extension=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){ ?>
                            <img style="cursor: pointer;"  class="img-circle" src="img/word.png" alt="service 3">
                            <?php } ?>
                            <?php if($result->archivo_extension=='application/vnd.ms-excel'){ ?>
                            <img style="cursor: pointer;"  class="img-circle" src="img/exel.png" alt="service 3">
                            <?php } ?>
                                     <?php echo $result->archivo_nombre ?>
                            <?php    
                            }else{ ?>
                                <input type="file" id="file_doc" name="file_doc">
                            <?php }
                        }else{ ?>
                        <input type="file" id="file_doc" name="file_doc">
                        <?php } ?>
                        </div>
                        <!--<input type="file" accept="image/capture=camera">-->
                        <div id="div_archivo_nuevo" style="display: none;">
                        
                        <!--<input type="file" id="file_doc" name="file_doc">-->
                        
                        </div>
                    </div>
                    <?php 
                    if($result->id_registro){
                    ?>    
                    <div class="form-group">
                        <label>Estado</label>
                        <select style="width: 200px;"  class="form-control" id="estado" name="estado">
                            <option value="">SELECCIONE UN ESTADO</option>
                            <option <?php echo ($result->estado=='A')?"selected":""; ?> value="A">ALTA</option>
                            <option <?php echo ($result->estado=='B')?"selected":""; ?>  value="B">BAJA</option>
                            
                        </select>
                    </div>     
                    <?php } ?>    
                    <input type="hidden"  name="action" value="guardar_documento" />
                    <input type="hidden" id="id_registro" name="id_registro"  name="action" value="<?php echo (isset($result->id_registro))?$result->id_registro:""; ?>" />
                    <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                    <button onclick="volver_listado()" type="reset"  class="btn btn-default">Volver</button>
                    </form>
                </div>    
            </div>    
        </div>
    </div>
</div>
    <?php include 'footer.php'; ?>