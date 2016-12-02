<?php
/**
 * MultidatabaseMetadata edit_form row template
 * - $layout: MultidatabaseMetadataLayout
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

$row = $layout['MultidatabaseMetadataLayout']['id'];
$col = $layout['MultidatabaseMetadataLayout']['col'];
?>

<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<div class="pull-left">
			<strong><?php echo sprintf(__d('multidatabase', '%s row'), $row); ?></strong>
		</div>
		<div class="pull-right">
			<?php echo $this->MultidatabaseMetadata->editCol($layout); ?>
		</div>
	</div>

	<div class="panel-body">
		<p class="text-right">
			<?php echo $this->Button->addLink('', array('action' => 'add', $row, $col), array('iconSize' => 'btn-sm')); ?>
		</p>

		<div class="row">
			<?php echo $this->MultidatabaseMetadataLayout->renderCol('Multidatabases/edit_form_metadata_col', $layout); ?>
		</div>
	</div>
</div>
