<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Nota
{
	private $table = 'nota';
	//Implementamos nuestro constructor
	public function __construct() {}

	private function ejecutarConsulta($sql, $params,)
	{
		try {
			require_once "../config/global.php";
			$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$stmt = $conexion->prepare($sql);

			if (!$stmt) {
				throw new Exception("Error preparing statement: " . $conexion->error);
			}
			call_user_func_array([$stmt, 'bind_param'], array_merge([str_repeat('s', count($params))], $params));
			$stmt->execute();
			if ($stmt->error) {
				throw new Exception("Error executing query: " . $stmt->error);
			}
			return array('stmt' => $stmt, 'last_id' => $conexion->insert_id);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
	}

	//Implementamos un método para insertar registros
	public function insertar($idestudiante, $idasingatura, $nota)
	{
		try {

			$sql = "INSERT INTO $this->table(idestudiante, idasignatura, nota)VALUES(?, ?, ?);";
			$params = array($idestudiante, $idasingatura, $nota);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para editar registros
	public function editar($id, $idestudiante, $idasingatura, $nota)
	{
		$sql = "UPDATE $this->table SET idestudiante=$idestudiante, idasingatura = $idasingatura, nota = $nota  WHERE idnota='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql = "DELETE FROM $this->table WHERE idnota = $id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM $this->table WHERE idnota='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT notas.idnota, notas.nota, est.nombres as estudiante, asi.nombre as asignatura, cu.nombre as curso 
		FROM $this->table notas
		INNER JOIN estudiante as est ON est.idestudiante = notas.idestudiante
		INNER JOIN asignatura as asi ON asi.idasignatura = notas.idasignatura
        INNER JOIN asignaturacurso asicu ON asicu.idasingatura = asi.idasignatura
		INNER JOIN curso as cu on cu.idcurso = asicu.idcurso
		";
		return ejecutarConsulta($sql);
	}
}
