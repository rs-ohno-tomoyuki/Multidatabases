<?php
/**
 * Multidatabase Helper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * 汎用データベースメタデータのレイアウトで使用するHelper
 *
 * このHelperを使う場合、
 * [Multidatabases.MultidatabaseLayoutComponent](./MultidatabaseLayoutComponent.html)
 * が読み込まれている必要がある。
 *
 * @author Tomoyuki Ohno (Ricksoft Inc.) <ohno.tomoyuki@ricksoft.jp>
 * @package NetCommons\Multidatabase\View\Helper
 */
class MultidatabaseLayoutHelper extends AppHelper {

/**
 * 使用するHelpsers
 *
 * - [NetCommons.ButtonHelper](../../NetCommons/classes/ButtonHelper.html)
 * - [NetCommons.NetCommonsHtml](../../NetCommons/classes/NetCommonsHtml.html)
 * - [NetCommons.NetCommonsForm](../../NetCommons/classes/NetCommonsForm.html)
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Button',
		'NetCommons.NetCommonsHtml',
		'NetCommons.NetCommonsForm'
	);

/**
 * CSS Style Sheetを読み込む
 *
 * @param string $viewFile viewファイル
 * @return void
 * @link http://book.cakephp.org/2.0/ja/views/helpers.html#Helper::beforeRender Helper::beforeRender
 */
	public function beforeRender($viewFile) {
		$this->NetCommonsHtml->css('/multidatabases/css/style.css');
		parent::beforeRender($viewFile);
	}

/**
 * 汎用データベースメタデータレイアウトのHTMLを出力する(段目)
 *
 * @param string $elementFile elementファイル名
 * @return string HTML
 */
	public function renderRow($elementFile) {
		$output = '';

		foreach ($this->_View->viewVars['multidatabaseLayouts'] as $layout) {
			$output .= $this->_View->element($elementFile, array(
				'layout' => $layout,
			));
		}
		return $output;
	}

/**
 * 汎用データベースメタデータレイアウトのHTMLを出力する(列)
 *
 * @param string $elementFile elementファイル名
 * @param array $layout multidatabaseLayoutデータ配列
 * @return string HTML
 */
	public function renderCol($elementFile, $layout) {
		$output = '';

		$row = $layout['MultidatabaseLayout']['id'];
		for ($col = 1; $col <= MultidatabaseLayout::LAYOUT_COL_NUMBER; $col++) {
			if ((int)Hash::get((array)$layout, 'MultidatabaseLayout.col') === 0) {
				continue;
			}
			if ($layout['MultidatabaseLayout']['col'] === '2' &&
					! isset($this->_View->viewVars['multidatabases'][$row][1]) &&
					isset($this->_View->viewVars['multidatabases'][$row][2])) {
				$colSm = 'col-sm-offset-6 col-sm-6';
			} else {
				$colSm = 'col-sm-' . (12 / $layout['MultidatabaseLayout']['col']);
			}
			$output .= '<div class="col-xs-12 ' . $colSm . '">';

			if (isset($this->_View->viewVars['multidatabases'][$row][$col])) {
				foreach ($this->_View->viewVars['multidatabases'][$row][$col] as $multidatabase) {
					$output .= $this->_View->element($elementFile, array(
						'layout' => $layout,
						'multidatabase' => $multidatabase
					));
				}
			}

			$output .= '</div>';
		}
		return $output;
	}

}
