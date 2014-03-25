<?php

# Collectd Curl plugin
# (just timings - based off of ping)

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# curl-<url>/response_time.rrd

$obj = new Type_Default($CONFIG);
$obj->data_sources = array('value');
$obj->ds_names = array('value' => 'Latency');
$obj->rrd_format = '%5.4lf';

switch($obj->args['type']) {
	case 'response_time':
		$obj->rrd_title = sprintf('%s', $obj->args['pinstance']);
		$obj->rrd_vertical = 'Seconds';
		break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();
