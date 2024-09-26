<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Estudiante
{
	private $table = 'estudiante';
	private $cursoestudiante = 'cursoestudiante';
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
	public function insertar($nombre, $papeleria, $numero, $direccion, $edad)
	{
		try {
			$sql = "INSERT INTO $this->table(nombres,papeleria,numero,direccion,edad)VALUES(?,?,?,?,?);";
			$params = array($nombre, $papeleria, $numero, $direccion, $edad);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para editar registros
	public function editar($id, $nombre, $papeleria, $numero, $direccion, $edad)
	{
		$sql = "UPDATE $this->table SET nombres='$nombre', papeleria='$papeleria', numero='$numero', direccion='$direccion', edad='$edad' WHERE idestudiante='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql = "DELETE FROM $this->table WHERE idestudiante = $id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM $this->table WHERE idestudiante='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM $this->table";
		return ejecutarConsulta($sql);
	}

	public function listarCursos($id)
	{
		$sql = "SELECT cu.nombre as curso, est.nombres as estudiante, cursstu.idcursoestudiante FROM cursoestudiante cursstu 
		INNER JOIN estudiante est  ON est.idestudiante = cursstu.idestudiante
		INNER JOIN curso cu ON cursstu.idcurso = cu.idcurso
		WHERE est.idestudiante = $id";
		return ejecutarConsulta($sql);
	}

	public function insertarcurso($curso, $idestudiante)
	{
		try {
			$sql = "INSERT INTO $this->cursoestudiante(idcurso, idestudiante)VALUES(?, ?);";
			$params = array($curso, $idestudiante);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function desactivarcurso($id)
	{
		$sql = "DELETE FROM $this->cursoestudiante WHERE idcursoestudiante = $id";
		return ejecutarConsulta($sql);
	}

	public function countMonth()
	{
		$sql = "SELECT COUNT(*) AS count FROM $this->table;";
		return ejecutarConsulta($sql);
	}
}
