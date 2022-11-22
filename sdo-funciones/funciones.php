<?php

function getReporte($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM reportes_generales WHERE idReporte=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idReporte'] = $id;
    $datos['nomReporte'] = $row['nomReporte'];
    $datos['turnoReporte'] = $row['turnoReporte'];
    $datos['fechaReporte'] = $row['fechaReporte'];
    $datos['folioReporte'] = $row['folioReporte'];
    $datos['nomEncargadoTurno'] = $row['nomEncargadoTurno'];
    $datos['nomFuncionariosTurno'] = $row['nomFuncionariosTurno'];
    $datos['nomEncargadoTurnoAnterior'] = $row['nomEncargadoTurnoAnterior'];
    $datos['tareasControlCentralizado'] = $row['tareasControlCentralizado'];
    $datos['tareasInstalaciones'] = $row['tareasInstalaciones'];
    $datos['tareasEquiposIndustriales'] = $row['tareasEquiposIndustriales'];
    $datos['tareasIncendiosCombustibles'] = $row['tareasIncendiosCombustibles'];
    $datos['tareasDeteccionElectrica'] = $row['tareasDeteccionElectrica'];
    $datos['tareasInfraestructura'] = $row['tareasInfraestructura'];
    $datos['pendientesCoordinacion'] = $row['pendientesCoordinacion'];
    return $datos;
  }
}
// FIN FUNCION

function getOrdenTrabajo($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM ordenes_trabajos WHERE idOrden=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idOrden'] = $id;
    $datos['folioOrden'] = $row['folioOrden'];
    $datos['nomOrden'] = $row['nomOrden'];
    $datos['fechaOrden'] = $row['fechaOrden'];
    $datos['nomSolicitante'] = $row['nomSolicitante'];
    $datos['nomTecnicoRecepcionador'] = $row['nomTecnicoRecepcionador'];
    $datos['idDepartamento'] = $row['idDepartamento'];
    $datos['nomDepartamento'] = getNomDepartamento($row['idDepartamento']);
    $datos['idSubDepartamento'] = $row['idSubDepartamento'];
    $datos['nomSubDepartamento'] = '';
    if ($datos['idSubDepartamento'] == 0 || $datos['idSubDepartamento'] < 0) {
      $datos['nomSubDepartamento'] = 'Error';
    } else {
      $datos['nomSubDepartamento'] = getNomSubDepartamento($row['idSubDepartamento']);
    }
    $datos['servicioOrden'] = $row['servicioOrden'];
    $datos['recintoOrden'] = $row['recintoOrden'];
    $datos['pmaOrden'] = $row['pmaOrden'];
    $datos['coordenadasOrden'] = $row['coordenadasOrden'];
    $datos['detalleTrabajo'] = $row['detalleTrabajo'];
    $datos['comentariosTrabajos'] = $row['comentariosTrabajos'];
    $datos['recepcionistaOrden'] = $row['recepcionistaOrden'];
    $datos['ejecutorOrden'] = $row['ejecutorOrden'];
    $datos['autorizadorOrden'] = $row['autorizadorOrden'];
    return $datos;
  }
}
// FIN FUNCION

// FIN FUNCION
function existeFotoReporte($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM imagenes WHERE idReporte=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    return  'Existe';
  } else {
    return 'No';
  }
}
// FIN FUNCION

function existeFotoOrden($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM imagenes WHERE idOrden=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    return  'Existe';
  } else {
    return 'No';
  }
}
// FIN FUNCION

function existeFotoSolicitud($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM imagenes_soporte WHERE idSolicitud=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    return  'Existe';
  } else {
    return 'No';
  }
}
// FIN FUNCION

function getCantReportes($id)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) as totalReportes FROM reportes_generales WHERE idPersonal=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['totalReportes'];
}
// FIN FUNCION


function getNomPersonal($id)
{
  include('conexion.php');
  $query = 'SELECT nomPersonal FROM personal WHERE idPersonal=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomPersonal'];
}
// FIN FUNCION

function getDatosPersonal($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM personal WHERE idPersonal=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idPersonal'] = $id;
    $datos['nomPersonal'] = $row['nomPersonal'];
    $datos['cargoPersonal'] = $row['cargoPersonal'];
    $datos['emailPersonal'] = $row['emailPersonal'];
    $datos['userPersonal'] = $row['userPersonal'];
    $datos['passPersonal'] = $row['passPersonal'];
    $datos['activoPersonal'] = $row['activoPersonal'];
    $datos['departamentoPersonal'] = $row['departamentoPersonal'];
    $datos['idSubdepartamento'] = $row['idSubdepartamento'];
    return $datos;
  }
}
// FIN FUNCION

function getDatosJefe($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM jefes_tecnicos WHERE idJefe=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idJefe'] = $id;
    $datos['nomJefe'] = $row['nomJefe'];
    $datos['cargoJefe'] = $row['cargoJefe'];
    $datos['userJefe'] = $row['userJefe'];
    $datos['passJefe'] = $row['passJefe'];
    $datos['emailJefe'] = $row['emailJefe'];
    $datos['idDepartamento'] = $row['idDepartamento'];
    $datos['idSubdepartamento'] = $row['idSubdepartamento'];
    return $datos;
  }
}
// FIN FUNCION

function existePersonal($user)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM personal WHERE userPersonal='" . $user . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function existeJefe($jefe)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM jefes_tecnicos WHERE userJefe='" . $jefe . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function existeAdministrador($user)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM administracion WHERE userAdministrador='" . $user . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function getNomDepartamento($id)
{
  include('conexion.php');
  $query = 'SELECT nomDepartamento FROM departamentos WHERE idDepartamento=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomDepartamento'];
}
// FIN FUNCION

function getCargoPersonal($id)
{
  include('conexion.php');
  $query = 'SELECT cargoPersonal FROM personal WHERE idPersonal=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['cargoPersonal'];
}
// FIN FUNCION

function getNomSubDepartamento($id)
{
  include('conexion.php');
  $query = 'SELECT nomSubDepartamento FROM subdepartamentos WHERE idSubDepartamento=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomSubDepartamento'];
}
// FIN FUNCION

function fechaEspañol($FechaStamp)
{
  $ano = date('Y', $FechaStamp);
  $mes = date('n', $FechaStamp);
  $dia = date('d', $FechaStamp);
  $diasemana = date('w', $FechaStamp);
  $diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
  $mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  return $diassemanaN[$diasemana] . " $dia de " . $mesesN[$mes] . " de $ano";
}

function fechaEspañol2($FechaStamp)
{
  $ano = date('Y', $FechaStamp);
  $mes = date('n', $FechaStamp);
  $dia = date('d', $FechaStamp);
  $mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  return " $dia de " . $mesesN[$mes] . " de $ano";
}

function contarImagen($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM imagenes WHERE idReporte='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function contarImagenSolicitud($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM imagenes_soporte WHERE idSolicitud='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function getRutaImagen($id)
{
  include('conexion.php');
  $query = "SELECT rutaImagen FROM imagenes WHERE idImagen='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['rutaImagen'];
}
// FIN FUNCION

function getReporteImagen($id)
{
  include('conexion.php');
  $query = "SELECT idReporte FROM imagenes WHERE idImagen='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idReporte'];
}
// FIN FUNCION

function contarMateriales($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM material_orden WHERE idOrden='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function contarMaterialesSolicitud($id)
{
  include('conexion.php');
  $query = "SELECT count(*) AS total FROM material_solicompra_tickets_pm msc INNER JOIN solicitudes_compra_tickets_pm sc ON msc.idSoliCompra = sc.idSoliCompra WHERE sc.idSolicitudSoporte='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function getNomServicio($id)
{
  include('conexion.php');
  $query = "SELECT nomServicio FROM servicios WHERE idServicio='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomServicio'];
}
// FIN FUNCION


function contarImagenOrden($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM imagenes WHERE idOrden='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function buscarServicio($nomServicio)
{
  include('conexion.php');
  $query = "SELECT idServicio FROM servicios WHERE nomServicio LIKE '" . $nomServicio . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idServicio'];
}

// FIN FUNCION

function buscarCategoria($nomCategoria)
{
  include('conexion.php');
  $query = "SELECT idCategoria FROM categorias_herramienta WHERE nomCategoria LIKE '" . $nomCategoria . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idCategoria'];
}
// FIN FUNCION

function getNomCategoria($id)
{
  include('conexion.php');
  $query = "SELECT nomCategoria FROM categorias WHERE idCategoria='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomCategoria'];
}
// FIN FUNCION

function getNomSubCategoria($id)
{
  include('conexion.php');
  $query = "SELECT nomSubcategoria FROM subcategorias WHERE idSubcategoria='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomSubcategoria'];
}
// FIN FUNCION

function getNomEquipo($id)
{
  include('conexion.php');
  $query = "SELECT nomEquipo FROM equipos WHERE idEquipo='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomEquipo'];
}
// FIN FUNCION

function getCategoriaEquipo($id)
{
  include('conexion.php');
  $query = "SELECT e.idEquipo AS idEquipo, e.nomEquipo AS nomEquipo, c.idCategoria AS idCategoria, c.nomCategoria AS nomCategoria FROM categorias c INNER JOIN subcategorias sc ON c.idCategoria = sc.idCategoria INNER JOIN equipos e ON sc.idSubcategoria = e.idSubCategoria WHERE e.idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomCategoria'];
}
// FIN FUNCION

function getSubCategoriaConEquipo($id)
{
  include('conexion.php');
  $query = "SELECT e.idEquipo AS idEquipo, e.nomEquipo AS nomEquipo, sc.nomSubCategoria AS nomSubCategoria, c.idCategoria AS idCategoria, c.nomCategoria AS nomCategoria FROM categorias c INNER JOIN subcategorias sc ON c.idCategoria = sc.idCategoria INNER JOIN equipos e ON sc.idSubcategoria = e.idSubCategoria WHERE e.idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomSubCategoria'] . ' / ' . $dato['nomEquipo'];
}
// FIN FUNCION

function getCategoriaSegunSubcategoria($id)
{
  include('conexion.php');
  $query = "SELECT idCategoria FROM subcategorias WHERE idSubcategoria='" . $id . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idCategoria'];
}
// FIN FUNCION

function getStatusForzado($id)
{
  include('conexion.php');
  $query = "SELECT forzadoEquipo FROM equipos WHERE idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['forzadoEquipo'];
}
// FIN FUNCION

function getStatusForzadoEncendido($id)
{
  include('conexion.php');
  $query = "SELECT forzadoEncendido FROM equipos WHERE idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['forzadoEncendido'];
}
// FIN FUNCION

function getStatusForzadoApagado($id)
{
  include('conexion.php');
  $query = "SELECT forzadoApagado FROM equipos WHERE idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['forzadoApagado'];
}
// FIN FUNCION

function getStatusForzadoVariables($id)
{
  include('conexion.php');
  $query = "SELECT forzadoVariable FROM equipos WHERE idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['forzadoVariable'];
}
// FIN FUNCION

function getStatusAutomatico($id)
{
  include('conexion.php');
  $query = "SELECT modoAutomatico FROM equipos WHERE idEquipo = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['modoAutomatico'];
}
// FIN FUNCION

function contarEquiposForzados()
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM equipos WHERE forzadoEquipo='1'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function getUltimoRegistroForzado($id)
{
  include('conexion.php');
  $query = 'SELECT idEquipo, detalleObservaciones, fechaObservaciones, personalObservacion, esForzado FROM equipos_observaciones WHERE idEquipo = ' . $id . ' AND esForzado NOT LIKE "%Observación Normal%" AND esForzado NOT LIKE "%Modo Automatico%" ORDER BY fechaObservaciones DESC LIMIT 1';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idEquipo'] = $row['idEquipo'];
    $datos['detalleObservaciones'] = $row['detalleObservaciones'];
    $datos['fechaObservaciones'] = $row['fechaObservaciones'];
    $datos['personalObservacion'] = $row['personalObservacion'];
    $datos['esForzado'] = $row['esForzado'];
    return $datos;
  }
}
// FIN FUNCION

function contarPersonal($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM personal WHERE departamentoPersonal=" . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function contarJefe($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM jefes_tecnicos WHERE idDepartamento=" . $id;

  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function existeSubcategoria($subcategoria, $idCategoria)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM subcategorias WHERE nomSubcategoria LIKE '" . $subcategoria . "' AND idCategoria = '" . $idCategoria . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function existeEquipo($nomEquipo, $categoriaAgregar)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM equipos WHERE nomEquipo LIKE '" . $nomEquipo . "' AND idSubCategoria = '" . $categoriaAgregar . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function contarSubCategoria($idCategoria)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM subcategorias WHERE idCategoria = '" . $idCategoria . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function contarEquipos($idSubCategoria)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM equipos WHERE idSubCategoria = '" . $idSubCategoria . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function getActa($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM actas WHERE idActa=' . $id . '';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idActa'] = $id;
    $datos['folioActa'] = $row['folioActa'];
    $datos['fechaActa'] = $row['fechaActa'];
    $datos['rutTarjeta'] = $row['rutTarjeta'];
    $datos['codigoTarjeta'] = $row['codigoTarjeta'];
    $datos['nomTarjeta'] = $row['nomTarjeta'];
    $datos['unidadTarjeta'] = $row['unidadTarjeta'];
    $datos['nomSolicitante'] = $row['nomSolicitante'];
    $datos['nomControlCentralizado'] = $row['nomControlCentralizado'];
    $datos['calidadContractual'] = $row['calidadContractual'];
    $datos['numTelefono'] = $row['numTelefono'];
    $datos['tipoActa'] = $row['tipoActa'];
    return $datos;
  }
}
// FIN FUNCION

function getCreadorReporte($id)
{
  include('conexion.php');
  $query = "SELECT nomEncargadoTurno FROM reportes_generales WHERE idReporte = " . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomEncargadoTurno'];
}

function contarObservacionesSubCategoria($idSubCategoria)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM bitacora WHERE idSubCategoria = '" . $idSubCategoria . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function contarObservaciones()
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM bitacora";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerIDBitacora()
{
  include('conexion.php');
  $query = "SELECT idCategoria FROM categorias WHERE nomCategoria LIKE 'bitácora'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idCategoria'];
}
// FIN FUNCION

function getNomJefeTecnico($id)
{
  include('conexion.php');
  $query = 'SELECT nomJefe FROM jefes_tecnicos WHERE idJefe =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomJefe'];
}

function getNomAdministrador($id)
{
  include('conexion.php');
  $query = 'SELECT nomAdministrador FROM administracion WHERE idAdministrador =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomAdministrador'];
}

function obtenerFolioReporte($id)
{
  include('conexion.php');
  $query = 'SELECT folioReporte FROM reportes_generales WHERE idReporte =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['folioReporte'];
}

function obtenerNombreReporte($id)
{
  include('conexion.php');
  $query = 'SELECT nomReporte FROM reportes_generales WHERE idReporte =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomReporte'];
}

function getDownloadBitacora($id)
{
  include('conexion.php');
  $query = 'SELECT idDescargaB, fechaDescargaB, usuarioDescargaB, tipoDescargaB,comentarioDescargaB FROM descargas_bitacora WHERE idDescargaB = ' . $id . ' LIMIT 1';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idDescargaB'] = $row['idDescargaB'];
    $datos['fechaDescargaB'] = $row['fechaDescargaB'];
    $datos['usuarioDescargaB'] = $row['usuarioDescargaB'];
    $datos['tipoDescargaB'] = $row['tipoDescargaB'];
    $datos['comentarioDescargaB'] = $row['comentarioDescargaB'];
    return $datos;
  }
}
// FIN FUNCION

function obtenerFechaInicio()
{
  include('conexion.php');
  $query = 'SELECT fechaBitacora FROM bitacora ORDER BY fechaBitacora ASC LIMIT 1';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['fechaBitacora'];
}

function obtenerFechaTermino()
{
  include('conexion.php');
  $query = 'SELECT fechaBitacora FROM bitacora ORDER BY fechaBitacora DESC LIMIT 1';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['fechaBitacora'];
}

function revisarListadoBitacora()
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM bitacora ORDER BY fechaBitacora ASC';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function revisarListadoBitacoraFechas($fechaInicio, $fechaTermino)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM bitacora WHERE fechaBitacora BETWEEN "' . $fechaInicio . '" AND "' . $fechaTermino . '" ORDER BY fechaBitacora ASC';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function obtenerNombreRutCA($rut)
{
  include('conexion.php');
  $query = 'SELECT nomTarjeta FROM actas WHERE rutTarjeta = "' . $rut . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomTarjeta'];
}

function getIDInstrumentacion()
{
  include('conexion.php');
  $query = 'SELECT idDepartamento FROM departamentos WHERE nomDepartamento LIKE "Instrumentación"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idDepartamento'];
}

function getIDDepartamento($nomDepartamento)
{
  include('conexion.php');
  $query = 'SELECT idDepartamento FROM departamentos WHERE nomDepartamento LIKE "' . $nomDepartamento . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idDepartamento'];
}

function buscarPatente($patente)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM parking WHERE patenteParking LIKE "' . $patente . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}


function contarPatente($rut)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM parking WHERE rutParking LIKE "' . $rut . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}


function buscarCCAA($rut)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM control_acceso WHERE work_id LIKE "' . $rut . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function getDatosCCAA($work_id)
{
  include('conexion.php');
  $query = 'SELECT idControlAcceso, name, card_number, card_type, department FROM control_acceso WHERE work_id = ' . $work_id . ' LIMIT 1';
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idControlAcceso'] = $row['idControlAcceso'];
    $datos['name'] = $row['name'];
    $datos['card_number'] = $row['card_number'];
    $datos['card_type'] = $row['card_type'];
    $datos['department'] = $row['department'];
    return $datos;
  }
}
// FIN FUNCION

function existeAleatorio($aleatorioSolicitud)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE aleatorioSolicitud LIKE '" . $aleatorioSolicitud . "'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function consultarEstado($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT situacionSolicitud FROM solicitudes_soportes WHERE folioSolicitud LIKE "' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['situacionSolicitud'];
}

function contarConsultaEstado($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM solicitudes_soportes WHERE folioSolicitud LIKE "' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function contarSolicitudes()
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM solicitudes_soportes';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function getSolicitudSoporte($idSolicitud)
{
  include('conexion.php');
  $query = 'SELECT * FROM solicitudes_soportes WHERE idSolicitud = ' . $idSolicitud;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idSolicitud'] = $row['idSolicitud'];
    $datos['folioSolicitud'] = $row['folioSolicitud'];
    $datos['aleatorioSolicitud'] = $row['aleatorioSolicitud'];
    $datos['nomSolicitante'] = $row['nomSolicitante'];
    $datos['rutSolicitante'] = $row['rutSolicitante'];
    $datos['deptoSolicitante'] = $row['deptoSolicitante'];
    $datos['emailSolicitante'] = $row['emailSolicitante'];
    $datos['telefonoSolicitante'] = $row['telefonoSolicitante'];
    $datos['ubicacionSolicitud'] = $row['ubicacionSolicitud'];
    $datos['deptoResponsable'] = $row['deptoResponsable'];
    $datos['tipoProblemaSolicitud'] = $row['tipoProblemaSolicitud'];
    $datos['problemaSolicitud'] = $row['problemaSolicitud'];
    $datos['conclusionSolicitud'] = $row['conclusionSolicitud'];
    $datos['tecnicoSolicitud'] = $row['tecnicoSolicitud'];
    $datos['inicioSolicitud'] = $row['inicioSolicitud'];
    $datos['terminoSolicitud'] = $row['terminoSolicitud'];
    $datos['situacionSolicitud'] = $row['situacionSolicitud'];
    $datos['canceladaSolicitud'] = $row['canceladaSolicitud'];
    $datos['finalizadaSolicitud'] = $row['finalizadaSolicitud'];    
    $datos['nuevaObservacion'] = $row['nuevaObservacion'];
    return $datos;
  }
}
// FIN FUNCION

function getNomTipoSolicitud($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT nomTipoSolicitud FROM solicitudes_tipos WHERE idTipoSolicitud=' . $folioSolicitud . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nomTipoSolicitud'];
}
// FIN FUNCION

function getNomPersonalSolicitud($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT tecnicoSolicitud FROM solicitudes_soportes WHERE folioSolicitud="' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['tecnicoSolicitud'];
}
// FIN FUNCION

function getNomDeptoSolicitud($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT deptoResponsable FROM solicitudes_soportes WHERE folioSolicitud="' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['deptoResponsable'];
}
// FIN FUNCION

function getTerminoSolicitud($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT terminoSolicitud FROM solicitudes_soportes WHERE folioSolicitud="' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['terminoSolicitud'];
}
// FIN FUNCION

function getDetalleObservaSolicitudes($tipoObservaSolicitud, $idSolicitud)
{
  include('conexion.php');
  $query = 'SELECT detalleObservaSolicitudes FROM observaciones_solicitudes WHERE tipoObservaSolicitudes="' . $tipoObservaSolicitud . '" AND idSolicitud=' . $idSolicitud . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['detalleObservaSolicitudes'];
}
// FIN FUNCION

function getIDxFolio($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT idSolicitud FROM solicitudes_soportes WHERE folioSolicitud="' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['idSolicitud'];
}
// FIN FUNCION

function getEmailSolicitud($idSolicitud)
{
  include('conexion.php');
  $query = 'SELECT emailSolicitante FROM solicitudes_soportes WHERE idSolicitud=' . $idSolicitud . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['emailSolicitante'];
}
// FIN FUNCION

function getRazonesTerminoSolicitud($folioSolicitud)
{
  include('conexion.php');
  $query = 'SELECT conclusionSolicitud FROM solicitudes_soportes WHERE folioSolicitud="' . $folioSolicitud . '"';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['conclusionSolicitud'];
}
// FIN FUNCION


function getDeptoResponsableSolicitud($id)
{
  include('conexion.php');
  $query = 'SELECT deptoResponsable FROM solicitudes_soportes WHERE idSolicitud =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['deptoResponsable'];
}
// FIN FUNCION


function getFolioSolicitud($id)
{
  include('conexion.php');
  $query = 'SELECT folioSolicitud FROM solicitudes_soportes WHERE idSolicitud =' . $id . '';
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['folioSolicitud'];
}
// FIN FUNCION

function obtenerSolicitudesCreadas()
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE situacionSolicitud LIKE 'Solicitud Creada'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION


function obtenerSolicitudesAdministrativo($nomUsuario)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomUsuario . "%'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION


function obtenerSolicitudesSegunNombre($nomPersonal)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomPersonal . "%'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerSolicitudesSegunNombreJefe($nomPersonal)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomPersonal . " (Jefe %'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerSolicitudesSegunNombreProfesional($nomPersonal)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomPersonal . " (Profesional %'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerSolicitudesSegunNombreTecnico($nomPersonal)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomPersonal . " (Técnico %'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerSolicitudesSegunNombreAuxiliar($nomPersonal)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND tecnicoSolicitud LIKE '%" . $nomPersonal . " (Auxiliar %'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function obtenerSolicitudesSegunDepto($nomDepartamento)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_soportes WHERE finalizadaSolicitud = 0 AND canceladaSolicitud = 0 AND deptoResponsable LIKE '%" . $nomDepartamento . "%'";
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION


function revisarHistoricoEquiposID($id)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM equipos WHERE idSubCategoria = ' . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function getDescargaHistorico($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM descargas_historico_sistemas WHERE idDescargaH = ' . $id;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idDescargaH'] = $row['idDescargaH'];
    $datos['fechaDescargaH'] = $row['fechaDescargaH'];
    $datos['usuarioDescargaH'] = $row['usuarioDescargaH'];
    $datos['tipoDescargaH'] = $row['tipoDescargaH'];
    $datos['comentarioDescargaH'] = $row['comentarioDescargaH'];
    $datos['idSubCategoria'] = $row['idSubCategoria'];
    return $datos;
  }
}


function getEquiposSubCategoria($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM equipos WHERE idSubCategoria = ' . $id;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idEquipo'] = $row['idEquipo'];
    $datos['nomEquipo'] = $row['nomEquipo'];
    $datos['idSubCategoria'] = $row['idSubCategoria'];
    $datos['forzadoEquipo'] = $row['forzadoEquipo'];
    $datos['forzadoEncendido'] = $row['forzadoEncendido'];
    $datos['forzadoApagado'] = $row['forzadoApagado'];
    $datos['forzadoVariable'] = $row['forzadoVariable'];
    $datos['modoAutomatico'] = $row['modoAutomatico'];
    return $datos;
  }
}

function time_elapsed_string($ptime)
{
  $time_ago = strtotime($ptime);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "Recientemente";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "Hace 1 minuto.";
        }
        else{
            return "Hace $minutes minutos.";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "Hace 1 hora.";
        }else{
            return "Hace $hours horas.";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Ayer.";
        }else{
            return "Hace $days d&iacute;as.";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "Hace 1 mes.";
        }else{
            return "Hace $weeks meses.";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "Hace 1 mes.";
        }else{
            return "Hace $months meses.";
        }
    }
    //Years
    else{
        if($years==1){
            return "Hace 1 año.";
        }else{
            return "Hace $years años.";
        }
    }
}
//FIN FUNCION

function getDatosAdministrativo($idAdmTecnicos)
{
  include('conexion.php');
  $query = 'SELECT * FROM adm_tecnicos WHERE idAdmTecnicos = ' . $idAdmTecnicos;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idAdmTecnicos'] = $row['idAdmTecnicos'];
    $datos['nomAdmTecnicos'] = $row['nomAdmTecnicos'];
    $datos['userAdmTecnicos'] = $row['userAdmTecnicos'];
    $datos['passAdmTecnicos'] = $row['passAdmTecnicos'];
    $datos['emailAdmTecnicos'] = $row['emailAdmTecnicos'];
    return $datos;
  }
}
// FIN FUNCION

function getSoliCompra_ticket_pm($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM solicitudes_compra_tickets_pm WHERE idSoliCompra = ' . $id;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idSoliCompra'] = $row['idSoliCompra'];
    $datos['numSoliCompra'] = $row['numSoliCompra'];
    $datos['folioSoliCompra'] = $row['folioSoliCompra'];
    $datos['fechaSoliCompra'] = $row['fechaSoliCompra'];
    $datos['personalSoliCompra'] = $row['personalSoliCompra'];
    $datos['unidadSoliCompra'] = $row['unidadSoliCompra'];
    $datos['emailSoliCompra'] = $row['emailSoliCompra'];
    $datos['argumentosSoliCompra'] = $row['argumentosSoliCompra'];
    $datos['adjuntaCotizacion'] = $row['adjuntaCotizacion'];
    $datos['estadoSoliCompra'] = $row['estadoSoliCompra'];
    $datos['idSolicitudSoporte'] = $row['idSolicitudSoporte'];
    return $datos;
  }
}
// FIN FUNCION

function getSoliCompra_pm($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM solicitudes_compra_pm WHERE idSoliCompra = ' . $id;
  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    $datos['idSoliCompra'] = $row['idSoliCompra'];
    $datos['numSoliCompra'] = $row['numSoliCompra'];
    $datos['folioSoliCompra'] = $row['folioSoliCompra'];
    $datos['fechaSoliCompra'] = $row['fechaSoliCompra'];
    $datos['personalSoliCompra'] = $row['personalSoliCompra'];
    $datos['unidadSoliCompra'] = $row['unidadSoliCompra'];
    $datos['emailSoliCompra'] = $row['emailSoliCompra'];
    $datos['argumentosSoliCompra'] = $row['argumentosSoliCompra'];
    $datos['adjuntaCotizacion'] = $row['adjuntaCotizacion'];
    $datos['estadoSoliCompra'] = $row['estadoSoliCompra'];
    return $datos;
  }
}
// FIN FUNCION

function getSoliReserva($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM solicitudes_reserva WHERE idSoliReserva = ' . $id;

  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    //$datos['idSoliReserva '] = $row['idSoliReserva '];
    $datos['numReserva'] = $row['numReserva'];
    $datos['folioSoliCompra'] = $row['folioSoliCompra'];
    $datos['numeroCompra'] = $row['numeroCompra'];
    $datos['observaciones'] = $row['observaciones'];
    $datos['fechaSoliReserva'] = $row['fechaSoliReserva'];
    $datos['idPersonal'] = $row['idPersonal'];
    $datos['idDepartamento'] = $row['idDepartamento'];
    $datos['email'] = $row['email'];
    $datos['estadoSoliReserva'] = $row['estadoSoliReserva'];
    return $datos;
  }
}
// FIN FUNCION

function getSoliReservaHis($id)
{
  include('conexion.php');
  $query = 'SELECT * FROM solicitudes_reserva_finalizadas WHERE idSoliReserva = ' . $id;

  // var_dump($query);
  // exit;

  $res = mysqli_query($conexion, $query);
  $row = $res->fetch_assoc();
  mysqli_close($conexion);
  if ($row) {
    $datos = array();
    //$datos['idSoliReserva '] = $row['idSoliReserva '];
    $datos['numReserva'] = $row['numReserva'];
    $datos['folioSoliCompra'] = $row['folioSoliCompra'];
    $datos['fechaSoliReserva'] = $row['fechaSoliReserva'];
    $datos['idPersonal'] = $row['idPersonal'];
    $datos['idDepartamento'] = $row['idDepartamento'];
    $datos['email'] = $row['email'];
    $datos['estadoSoliReserva'] = $row['estadoSoliReserva'];
    return $datos;
  }
}
// FIN FUNCION


function contarMaterialesSC($id)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM material_soli_reserva WHERE idSoliReserva = ' . $id;
  // var_dump($query);
  // exit;

  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

// FIN FUNCION


function contarMaterialesSC2($id)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM material_soli_reserva WHERE idSoliReserva = ' . $id;
  // var_dump($query);
  // exit;

  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function contarMaterialesSCPM($id)
{
  include('conexion.php');
  $query = 'SELECT COUNT(*) AS total FROM material_solicompra_pm WHERE idSoliCompra = ' . $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}

function contarSolicitudComprasSC($id)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_compra_tickets_pm WHERE idSolicitudSoporte = ". $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function getNuevaObservacionSolicitud($id)
{
  include('conexion.php');
  $query = "SELECT nuevaObservacion FROM solicitudes_soportes WHERE idSolicitud = ". $id;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['nuevaObservacion'];
}
// FIN FUNCION

function existeNumInterno($numSoliCompra)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_compra_tickets_pm WHERE numSoliCompra = ". $numSoliCompra;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function existeNumInternoPM($numSoliCompra)
{
  include('conexion.php');
  $query = "SELECT COUNT(*) as total FROM solicitudes_compra_pm WHERE numSoliCompra = ". $numSoliCompra;
  $res = mysqli_query($conexion, $query);
  $dato = mysqli_fetch_assoc($res);
  return $dato['total'];
}
// FIN FUNCION

function getIniciales($nombre){

  $nombre = explode(' (',$nombre);

  $name = '';
  $explode = explode(' ',$nombre[0]);
  foreach($explode as $x){
      $name .=  $x[0];
  }
  return $name;    
}


