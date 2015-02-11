<?php namespace App;

use Form;

class Modal {
	public $type, $title, $body, $buttons, $objectName, $objectType, $form;
	public $warnings = null;

	public function __construct() {
		// only one default button which is close
		$this->buttons = [
			'close' => [
				'text' => 'Close',
				'class' => 'btn btn-default',
				'data' => [
					'dismiss' => 'modal'
				]
			]
		];
	}

	public function printButtons() {
		// init the button so it at least returns an empty string
		$btnText = '';
		foreach ( $this->buttons as $button ) {
			$class = $button['class'];
			$data = '';
			if ( !empty($button['data']) ) {
				foreach ( $button['data'] as $k => $v ) {
					$data .= sprintf('data-%s="%s" ', $k, $v);
				}
			}
			$text = $button['text'];
			// close up the button
			$btnText .= sprintf('<button type="button" class="%s" %s>%s</button>', $class, $data, $text);
		}
		return $btnText;
	}

	public function setDelete($data) {
		$this->title = 'Delete '.$data['name'].'?';
		$this->body = 'components.modals.delete';
		$this->form = Form::open( ['method'=>'DELETE', 'action' => [$data['controller'], $data['id']], 'id' => 'modalForm'] ) . Form::close();
		$this->buttons = $this->getDeleteButtons();
		$this->objectType = $data['type'];
		$this->objectName = $data['name'];
	}

	public function getDeleteButtons() {
		$buttons = [
			'delete' => [
				'text' => 'DELETE',
				'class' => 'btn btn-danger post',
				'data' => [
					'target' => '#modalForm'
				]
			],
			'close' => [
				'text' => 'Cancel',
				'class' => 'btn btn-default',
				'data' => [
					'dismiss' => 'modal'
				]
			]
		];
		return $buttons;
	}
}