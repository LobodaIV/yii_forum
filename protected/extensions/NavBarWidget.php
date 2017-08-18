<?php 

class NavBarWidget extends CWidget {

	public function getLink($text,$url,$params = array()) {
		$path = $this->controller->createUrl($url,$params);
		$s = Yii::app()->request->url;
		$pos = strpos($s, '?');

		if ($pos !== false) {
			$s = substr($s, 0, $pos);
		}

		if ($path == $s) {
			$opt = array("class" => "active");
		} else {
			$opt = array();
		}

		return CHtml::link($text,$path,$opt);
	}

	public function run() {
		$this->render('navbarwidget');
	}

}