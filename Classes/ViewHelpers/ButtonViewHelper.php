<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_Flattr_ViewHelpers_ButtonViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractTagBasedViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'a';

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();

		$this->registerUniversalTagAttributes();
	}

	/**
	 * http://developers.flattr.net/button/
	 *
	 * @param  string $href
	 * @param  string $uid
	 * @param  string $category
	 * @param  array $tags
	 * @param bool $dataAttributes
	 * @param string $language
	 * @param null $button
	 * @param null $popout
	 * @param null $hidden
	 * @return string The rendered link tag
	 */
	public function render($href, $uid = NULL, $category = NULL, $tags = NULL, $dataAttributes = TRUE, $language='en_GB', $button = NULL, $popout = NULL, $hidden = NULL) {
		$GLOBALS['TSFE']->additionalHeaderData['flattr'] = t3lib_div::getURL(t3lib_extMgm::extPath('flattr') . 'Resources/Private/Partials/flattr.html');


		$attributes = array();
		if($uid !== NULL)      { $attributes['uid']      = $uid;}
		if($category !== NULL) { $attributes['category'] = $category;}
		if($language !== NULL) { $attributes['language'] = $language;}
		if($button !== NULL)   { $attributes['button']   = $button;}
		if($popout !== NULL)   { $attributes['popout']   = $popout;}
		if($hidden !== NULL)   { $attributes['hidden']   = $hidden;}

		if($tags !== NULL)     {$attributes['tags']     = implode(',', $tags);}

		if($dataAttributes === TRUE) {
			foreach($attributes as $key => $value) {
				$this->tag->addAttribute('data-flattr-' . $key, $value);
			}
		} else {
			$flattrControll = 'flattr;';
			foreach($attributes as $key => $value) {
				$flattrControll .= $key . ':' . $value . ';';
			}
			$this->tag->addAttribute('rel', $flattrControll);
		}
		$this->tag->addAttribute('class', 'FlattrButton');
		$this->tag->addAttribute('href', $href);
		$this->tag->addAttribute('style', 'display:none');

		$this->tag->setContent($this->renderChildren());

		return $this->tag->render();
	}
}

