<?php
/**
 * MultidatabaseBlockRolePermissionsController Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('MultidatabasesAppController', 'Multidatabases.Controller');

/**
 * MultidatabaseBlockRolePermissionsController Controller
 *
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @package NetCommons\Multidatabases\Controller
 */
class MultidatabaseBlockRolePermissionsController extends MultidatabasesAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'Multidatabases.Multidatabase',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit' => 'block_permission_editable',
			),
		),
	);

/**
 * use helpers
 *
 * @var array
 */
    public $helpers = array(
        'Blocks.BlockForm',
        'Blocks.BlockTabs' => array(
            'mainTabs' => array(
                'block_index' => array('url' => array('controller' => 'multidatabase_blocks')),
                'frame_settings' => array('url' => array('controller' => 'multidatabase_frame_settings')),
            ),
            'blockTabs' => array(
                'block_settings' => array('url' => array('controller' => 'multidatabase_blocks')),
                'mail_settings' => array('url' => array('controller' => 'multidatabase_mail_settings')),
                'role_permissions' => array('url' => array('controller' => 'multidatabase_block_role_permissions')),
            ),
        ),
        'Likes.Like',
    );
/**
 * edit
 *
 * @return void
 */
	public function edit() {
		if (! $multidatabase = $this->Multidatabase->getMultidatabase()) {
			return $this->throwBadRequest();
		}

		$permissions = $this->Workflow->getBlockRolePermissions(
			array(
				'content_creatable',
				'content_publishable',
				'content_comment_creatable',
				'content_comment_publishable'
			)
		);
		$this->set('roles', $permissions['Roles']);

		if ($this->request->is('post')) {
			if ($this->MultidatabaseSetting->saveMultidatabaseSetting($this->request->data)) {
				return $this->redirect(NetCommonsUrl::backToIndexUrl('default_setting_action'));
			}
			$this->NetCommons->handleValidationError($this->MultidatabaseSetting->validationErrors);
			$this->request->data['BlockRolePermission'] = Hash::merge(
				$permissions['BlockRolePermissions'],
				$this->request->data['BlockRolePermission']
			);

		} else {
			$this->request->data['MultidatabaseSetting'] = $multidatabase['MultidatabaseSetting'];
			$this->request->data['Block'] = $multidatabase['Block'];
			$this->request->data['BlockRolePermission'] = $permissions['BlockRolePermissions'];
			$this->request->data['Frame'] = Current::read('Frame');
		}
	}
}
