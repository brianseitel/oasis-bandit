<?

interface Saveable {
	// Increments an attempt for this ID
	public function attempt($id);
	// Increments a success for this ID
	public function success($id);
}