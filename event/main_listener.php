<?php
/**
 *
 * Hide User Age. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Lionel Rowe, https://github.com/lionel-rowe
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */
namespace luoning\hideuserage\event;

/**
 * @ignore
 */

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return [
			'core.page_header' => 'assign_template_vars',
			'core.index_modify_birthdays_list' => 'remove_birthday_ages',
		];
	}

	/* @var \phpbb\config\config */
	protected $config;
	/* @var \phpbb\language\language */
	protected $language;
	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\language\language $language,
		\phpbb\template\template $template
	)
	{
		$this->config = $config;
		$this->language = $language;
		$this->template = $template;
	}

	/**
	 * Load common language files during user setup
	 */
	public function load_language_on_setup(\phpbb\event\data $event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'luoning/hideuserage',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * remove ages from birthday list
	 */
	public function remove_birthday_ages(\phpbb\event\data $event)
	{
		$event['birthdays'] = array_map(
			function($birthday) {
				$birthday['AGE'] = '';

				return $birthday;
			},
			$event['birthdays']
		);
	}

	/**
	 * set template variables to blank to hide individual age
	 */
	public function assign_template_vars()
	{
		$this->template->assign_vars([
			'AGE' => '',
			'L_BIRTHDAY_EXPLAIN' => '',
		]);
	}
}
