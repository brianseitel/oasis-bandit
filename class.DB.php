<?

class DB {
	
	protected $db;

	public static function connect() {
		return new mysqli("127.0.0.1", "root", "", "test");
	}

	public static function update($sql) {
		$db = self::connect();
		$result = $db->query($sql);
		return $result;
	}

	public static function getArray($sql) {
		$array = array();
		$db = self::connect();
		$results = $db->query($sql);
		while ($row = $results->fetch_assoc())
			$array[] = $row;
		return $array;
	}
}