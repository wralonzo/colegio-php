<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Adjunto
{
	//Implementamos nuestro constructor
	public function __construct() {}
	private $table = 'diario';

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

	public function insertar($idUser, $path, $descripcion)
	{
		try {
			$sql = "INSERT INTO $this->table(iduser, path, descripcion)VALUES(?, ?, ?);";
			$params = array($idUser, $path, $descripcion);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql = "DELETE FROM $this->table WHERE iddiario = $id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM $this->table WHERE iddiario='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT u.nombre, diar.iddiario, diar.path, diar.datecreated, diar.iduser FROM $this->table diar INNER JOIN usuario u ON u.idusuario = diar.iduser ORDER BY diar.iddiario DESC";
		return ejecutarConsulta($sql);
	}

	public function countMonth()
	{
		$sql = "SELECT MONTH(datecreated) AS month, COUNT(*) AS user_count FROM $this->table WHERE estado = 1 GROUP BY MONTH(datecreated) ORDER BY MONTH(datecreated);";
		return ejecutarConsulta($sql);
	}
}
