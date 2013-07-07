<?php
/**
 * @var Ads $data
 */
?>

<h4><?=CHtml::link($data->title, array('/ads/ads/view', 'alias' => $data->alias))?></h4>
<div class="description">
	<?=$data->description?>
</div>
