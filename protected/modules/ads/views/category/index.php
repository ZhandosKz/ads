<?php
$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'placement' => 'left',
	'tabs' => Category::getMenuItems(),
));