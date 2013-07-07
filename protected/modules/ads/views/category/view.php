<?php
/**
 * @var CategoryController $this
 * @var Category $category
 */

?>

<blockquote>
	<?=$category->description?>
</blockquote>
<?php
$this->renderPartial('_adsCList', array(
	'dataProvider' => $dataProvider,
));
