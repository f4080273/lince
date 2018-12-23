<?
	if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	Class datalib{
		function push(){
			$html = '
			<div id="PushStyle">
			<a class="addthis_counter addthis_bubble_style"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_button_google_plusone"></a>
			<a class="addthis_button_preferred_4"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_1"></a>
			<br><br>
			</div>
			
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f4f3a65685a37d0"></script>
			<style type="text/css">	
				#PushStyle{
					
				}
				#PushStyle a{
					margin-left:10px;
					float:right;
				}
			</style>
			';
			return $html;
		}
	}
?>