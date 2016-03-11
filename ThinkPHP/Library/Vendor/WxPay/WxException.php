<?php

class WxException extends Exception {
	public function errorMessage() {
		return $this->getMessage ();
	}
}

?>