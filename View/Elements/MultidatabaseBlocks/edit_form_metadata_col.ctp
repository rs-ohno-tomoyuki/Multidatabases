<?php
/**
  * MultidatabaseMetadata edit_form col template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

if (Hash::get($multidatabase, 'MultidatabaseMetadataSetting.display')) {
	$class = ' list-group-item-success';
} else {
	$class = '';
}

?>

<ul class="multidatabase-edit">
	<li class="list-group-item clearfix<?php echo $class; ?>">
		<div class="pull-left multidatabase-display">
			<?php echo $this->MultidatabaseMetadata->displaySetting($multidatabase); ?>
		</div>
		<div class="pull-left multidatabase-move">
			<div class="btn-group">
				<?php echo $this->MultidatabaseMetadata->moveSetting($layout, $multidatabase); ?>
			</div>
		</div>

		<div class="pull-left">
			<?php echo h($multidatabase['MultidatabaseMetadata']['name']); ?>
			<?php if ($multidatabase['MultidatabaseMetadataSetting']['required']) : ?>
				<?php echo $this->element('NetCommons.required'); ?>
			<?php endif; ?>
		</div>

		<div class="pull-right">
			<?php echo $this->Button->editLink('',
					array('action' => 'edit', h($multidatabase['MultidatabaseMetadata']['key'])),
					array('iconSize' => 'btn-xs')
				); ?>
		</div>
	</li>
</ul>
