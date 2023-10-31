<?php

/**
 * Rishi_WP_Block_Parser
 * Helper object for including dynamic styles into head of the document,
 * with possibilities of extending it.
 *
 * 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package Rishi
 */
class Rishi_WP_Block_Parser extends WP_Block_Parser
{
	//TODO: Check Block parser can be moved to Companion ??
	function parse($document) {
		$result = parent::parse($document);

		$current_index = 0;
		$current_heading_index = 0;

		foreach ($result as $index => $first_level_block) {
			$result[$index]['firstLevelBlock'] = true;

			if (! empty(trim($first_level_block['innerHTML']))) {
				$result[$index]['firstLevelBlockIndex'] = $current_index++;

				if (
					strpos($first_level_block['blockName'], 'heading') !== false
					||
					strpos($first_level_block['blockName'], 'headline') !== false
					||
					in_array(
						substr(trim($first_level_block['innerHTML']), 0, 3),
						[
							'<h1', '<h2', '<h3',
							'<h4', '<h5', '<h6'
						]
					)
				) {
					$result[$index]['firstLevelHeadingIndex'] = $current_heading_index++;
				}
			}
		}

		return $result;
	}
}
