<?php
/**
 * MultidatabaseSettings edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->element('Blocks.form_hidden'); ?>

<?php echo $this->NetCommonsForm->hidden('Multidatabase.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Multidatabase.key'); ?>
<?php echo $this->NetCommonsForm->hidden('MultidatabaseSetting.use_workflow'); ?>
<?php echo $this->NetCommonsForm->hidden('MultidatabaseSetting.use_comment_approval'); ?>
<?php echo $this->NetCommonsForm->hidden('MultidatabaseFrameSetting.id'); ?>
<?php echo $this->NetCommonsForm->hidden('MultidatabaseFrameSetting.frame_key'); ?>
<?php echo $this->NetCommonsForm->hidden('MultidatabaseFrameSetting.articles_per_page'); ?>

<?php echo $this->NetCommonsForm->input('Multidatabase.name', array(
		'type' => 'text',
		'label' => __d('multidatabases', 'Multidatabase name'),
		'required' => true
	)); ?>

<?php echo $this->element('Blocks.public_type'); ?>

<?php echo $this->NetCommonsForm->inlineCheckbox('MultidatabaseSetting.use_comment', array(
			'label' => __d('multidatabases', 'Use comment')
	)); ?>

<?php echo $this->Like->setting('MultidatabaseSetting.use_like', 'MultidatabaseSetting.use_unlike'); ?>

<?php echo $this->MultidatabaseLayout->renderRow('MultidatabaseSetting/edit_form_metadata_row'); ?>
