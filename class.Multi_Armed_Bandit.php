<?

abstract class Multi_Armed_Bandit implements Saveable {

	const EXPLORATION_RATE = 10; // final_rate = 1 / EXPLORATION_RATE;
	private $items = array();

	public function __construct($items = array()) {
		$this->items = $items;
	}

	public function choose() {
		$rand = mt_rand(0, 10);
		if ($rand < 1)
			return $this->explore(); // Explore 1/Nth of the time
		else
			return $this->exploit(); // Exploit the rest
	}

	private function explore() {
		$rand = mt_rand(0, count($this->items) - 1);
		$item = $this->items[$rand];
		$this->attempt($rand + 1);
		return $this->items[$rand];
	}

	private function exploit() {
		$scores = array();
		foreach ($this->items as $item) {
			$scores[$item['id']] = $item['successes'] / $item['attempts'];
		}

		$max = -99999;
		foreach ($scores as $k => $v) {
			if ($v > $max) {
				$keymax = $k;
				$max = $v;
			}
		}

		$item = $this->items[$keymax - 1];

		$this->attempt($item['id']);
		
		return $this->items[$keymax - 1];
	}

	public static function reward($item_id) {
		$mab = new Bandito;
		$mab->success($item_id);
		return true;
	}
}