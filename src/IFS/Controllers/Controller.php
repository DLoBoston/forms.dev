<?php
/**
 * Parent controller that injects DI container via constructor.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Slim\Container;

/**
 * Parent controller that injects DI container via constructor
 */
class Controller {
    
	/** @var array Application dependency container */
	protected $container;

	/**
	 * Inject dependency container upon instantiation.
	 * 
	 * @param \Slim\Container $c Dependency container
	 * @return void
	 */
	public function __construct(Container $c)
	{
			$this->container = $c;
	}
}
