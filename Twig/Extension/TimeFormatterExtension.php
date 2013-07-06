<?php

namespace Hexmedia\TimeFormatterBundle\Twig\Extension;

use Hexmedia\TimeFormatterBundle\Templating\Helper\TimeFormatterHelper;

class TimeFormatterExtension extends \Twig_Extension {

	protected $translator;

	/**
	 * @var TimeFormatterHelper
	 */
	protected $helper;

	/**
	 * Constructor method
	 *
	 * @param IdentityTranslator $translator
	 * @param TimeFormatterHelper $helper
	 */
	public function __construct($translator, TimeFormatterHelper $helper) {
		$this->translator = $translator;
		$this->helper = $helper;
	}

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('time_formatter', array($this, 'TimeFormatterFilter')),
			new \Twig_SimpleFilter('simple_time_formatter', array($this, 'TimeFormatterFilterSimple'))
		);
	}

	/**
	 * As $fromTime and $toTime we can use timestamp as int, @\DateTime or string with format
	 * from $dateFormat
	 *
	 * @param \DateTime|string|int $fromTime
	 * @param \DateTime|string|int $toTime
	 * @param string $format simple - currently there is only idea to use this var
	 * @param string $dateFormat
	 *
	 * @return string
	 */
	public function TimeFormatterFilter($fromTime, $toTime = null, $format = null, $dateFormat = "Y-m-d H:i:s") {
		return $this->helper->TimeFormatter($fromTime, $toTime, $format, $dateFormat);
	}

	public function TimeFormatterFilterSimple($fromTime, $toTime = null, $dateFormat = "Y-m-d H:i:s") {
		return $this->helper->TimeFormatter($fromTime, $toTime, 'simple', $dateFormat);
	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName() {
		return 'time_formatter_extension';
	}

}
