<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Curso
{
	private $table = 'curso';
	private $tableAsignatura = 'asignaturacurso';
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
	public function insertar($nombre)
	{
		try {

			$sql = "INSERT INTO $this->table(nombre)VALUES(?);";
			$params = array($nombre);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para insertar registros
	public function insertarAsignatura($curso, $asignatura)
	{
		try {
			$sql = "INSERT INTO $this->tableAsignatura(idcurso, idasingatura)VALUES(?, ?);";
			$params = array($curso, $asignatura);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para editar registros
	public function editar($id, $nombre)
	{
		$sql = "UPDATE $this->table SET nombre='$nombre' WHERE idcurso='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql = "DELETE FROM $this->table WHERE idcurso = $id";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivarAsignatura($id)
	{
		$sql = "DELETE FROM $this->tableAsignatura WHERE idasignaturacurso = $id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM $this->table WHERE idcurso='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarAsignaturas($id)
	{
		$sql = "SELECT asg.idasignaturacurso, u.nombre as curso, asn.nombre as asignatura 
			FROM $this->tableAsignatura  asg
			INNER JOIN curso u  ON u.idcurso = asg.idcurso
			INNER JOIN asignatura asn ON asn.idasignatura = asg.idasingatura
			WHERE asg.idcurso=$id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM $this->table";
		return ejecutarConsulta($sql);
	}

	public function cursosEstudiantes($id)
	{
		$sql = "SELECT est.nombres, est.idestudiante FROM cursoestudiante ce
			INNER JOIN estudiante est ON ce.idestudiante = est.idestudiante
			INNER JOIN curso cu ON cu.idcurso = ce.idcurso
			WHERE cu.idcurso=$id";
		return ejecutarConsulta($sql);
	}

	public function cursoAsignaturas($id)
	{
		$sql = "SELECT asi.idasignatura, asi.nombre FROM `asignaturacurso` ac 
			INNER JOIN asignatura asi ON asi.idasignatura = ac.idasingatura
			INNER JOIN curso cu ON cu.idcurso = ac.idcurso
			WHERE cu.idcurso = $id";
		return ejecutarConsulta($sql);
	}

	public function countMonth()
	{
		$sql = "SELECT COUNT(*) AS count FROM $this->table;";
		return ejecutarConsulta($sql);
	}
}
