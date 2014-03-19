<?php

class AppError extends ErrorHandler {

	function cannotFindFile($params) {
		$this->controller->set('file', $params['file']);
		$this->_outputMessage('cannot_find_file');
	}

}

?>
