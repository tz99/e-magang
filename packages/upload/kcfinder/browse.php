<?php
/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */
// ini_set("safe_mode", Off"");
require "core/autoload.php";
$browser = new browser();
require_once __DIR__.'/../../../bootstrap/autoload.php';
$app = require_once __DIR__.'/../../../bootstrap/start.php';
$request = $app['request'];
$client = (new \Stack\Builder)
        ->push('Illuminate\Cookie\Guard', $app['encrypter'])
        ->push('Illuminate\Cookie\Queue', $app['cookie'])
        ->push('Illuminate\Session\Middleware', $app['session'], null);
$stack = $client->resolve($app);
$stack->handle($request);
$isAuthorized = Auth::check(); 
if(!$isAuthorized){
    die('Access Denied Bro');
}
$browser->action();

?>
