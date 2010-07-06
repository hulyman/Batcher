<?php
/**
 * Batcher
 *
 * Copyright 2010 by Shaun McCormick <shaun@modxcms.com>
 *
 * This file is part of Batcher, a batch resource editing Extra.
 *
 * Batcher is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Batcher is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Batcher; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package batcher
 */
/**
 * Loads the home page.
 *
 * @package batcher
 * @subpackage controllers
 */

if (empty($_REQUEST['template'])) return $modx->error->failure($modx->lexicon('batcher.template_err_ns'));
$template = $modx->getObject('modTemplate',$_REQUEST['template']);
if (empty($template)) return $modx->error->failure($modx->lexicon('batcher.template_err_nf'));

$tj = $template->get(array('id','templatename','description'));
$tj = $modx->toJSON($tj);
$modx->regClientStartupHTMLBlock('<script type="text/javascript">Ext.onReady(function() { Batcher.template = '.$tj.'; });</script>');

$modx->regClientStartupScript($modx->getOption('manager_url').'assets/modext/util/datetime.js');
$modx->regClientStartupScript($batcher->config['jsUrl'].'widgets/template/template.tvs.panel.js');
$modx->regClientStartupScript($batcher->config['jsUrl'].'sections/template/tvs.defaults.js');
$output = '<div id="batcher-panel-template-tvs-div"></div>';

return $output;
