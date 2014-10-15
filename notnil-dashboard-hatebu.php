<?php
/*
Plugin Name: Dashboard HATEBU
Description: Display Hatena Bookmark count on dashboard
Version: 0.1
License: GPL
Author: hissy
Author URI: http://notnil-creative.com
*/

/* 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/

if ( ! defined( 'ABSPATH' ) ) exit;

foreach( glob( dirname(__FILE__). '/class-*.php' ) as $class )
{
    require $class;
}

function notnil_dashboard_hatebu()
{
    return NotnilDashboardHatebu::instance();
}

add_action( 'plugins_loaded', 'notnil_dashboard_hatebu' );
