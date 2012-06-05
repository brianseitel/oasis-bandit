<?

class Bandit extends Multi_Armed_Bandit {
	
	public function attempt($item_id) {
		DB::update('UPDATE test.options SET attempts = attempts+1 WHERE id = '.$item_id);
	}

	public function success($item_id) {
		DB::update('UPDATE test.options SET successes = successes+1 WHERE id = '.$item_id);
	}
}