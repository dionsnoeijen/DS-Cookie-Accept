<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Ds cookie accept',
	'pi_version' => '0.1',
	'pi_author' => 'Dion Snoeijen',
	'pi_author_url' => 'http://www.diovisuals.com/',
	'pi_description' => 'Just accept the cookie',
	'pi_usage' => Ds_cookie_accept::usage()
);

class Ds_cookie_accept 
{
	private $EE;
	public $return_data = '';

	public function __construct() 
	{
		$this->EE =& get_instance();
	}

	public function message() {
		$accepted_cookies = $this->EE->input->cookie('ds_cookie_accept', false);
		$tagdata = $this->EE->TMPL->tagdata;
		if(!$accepted_cookies) {
			$include_js = $this->EE->TMPL->fetch_param('include_js', true);
			$include_css = $this->EE->TMPL->fetch_param('include_css', true);
			$title_text = $this->EE->TMPL->fetch_param('title_text', false);
			$link_text = $this->EE->TMPL->fetch_param('link_text', false);

			if(!$title_text) {
				$title_text = 'Deze website gebruikt cookies. Meer weten over cookies?';
			}
			if(!$link_text) {
				$link_text = 'Lees hier meer.';
			}


			if($include_css !== 'no') {
				$this->return_data .= $this->css();
			}

			$this->return_data .= '<div id="cookiemessage">';
			$this->return_data 		.= '<div id="themessage">';	
			$this->return_data 			.= '<p class="cookietext">' . $title_text . ' <a href="#" id="ds_cookie_accept_privacy">' . $link_text . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="ds_cookie_accept" class="btn">Sluiten</a></p>';
			$this->return_data 		.= '</div>';
			$this->return_data 		.= '<div id="ds_cookie_accept_privacy_details">';
			if($tagdata == '')	{
			$this->return_data 			.= '<h1>Cookiewet</h1><p class="cookietext">Cookies zijn kleine bestanden die in de webbrowser worden opgeslagen. Deze cookies worden gebruik om de website beter te laten functioneren en het web bezoek te monitoren.<br /><br />Het is mogelijk om het gebruik van cookies in uw browser uit te schakelen, zodat deze cookies niet geplaatst worden. Ook kunt u cookies die in het verleden in uw browser zijn geplaatst wissen. Via de volgende links kunt u vinden hoe u de instellingen van cookies in uw browser wijzigt en cookies in uw webbrowser kunt wissen:<br /><br /><a href="http://support.google.com/chrome/bin/answer.py?hl=nl&answer=95647" target="_blank">Chrome</a><br /><a href="http://support.mozilla.org/nl/kb/cookies-informatie-websites-op-uw-computer-opslaan?redirectlocale=nl&redirectslug=Cookies" target="_blank">Firefox</a><br /><a href="http://windows.microsoft.com/en-US/windows-vista/Block-or-allow-cookies" target="_blank">Microsoft</a><br /><br />Meer informatie over de cookie wetgeving is te bekijken op: <a href="http://www.rijksoverheid.nl/onderwerpen/ict/veilig-online-en-e-privacy/internetbezoek-volgen-met-cookies" target="_blank">http://www.rijksoverheid.nl/onderwerpen/ict/veilig-online-en-e-privacy/internetbezoek-volgen-met-cookies</a></p>';
			} else {
			$this->return_data 			.= $tagdata;
			}
			$this->return_data 		.= '</div>';
			$this->return_data .= '</div>';

			if($include_js !== 'no') {
				$this->return_data .= $this->jquery_javascript();
			}
			return $this->return_data;
		}
	}

	public function css() {
		$accepted_cookies = $this->EE->input->cookie('ds_cookie_accept', false);
		if(!$accepted_cookies) {
			$css = '<style type="text/css">';
			$css 	.= 'div#cookiemessage {position:fixed;bottom:0;text-align:center;width:100%;padding:5px 0;background:#000000;background:rgba(0,0,0,0.8);z-index:999;}';
			$css 	.= 'div#cookiemessage a,div#cookiemessage p {font-family: Arial, Helvetica, sans-serif; color:#ffffff;margin:0;padding:0;}';
			$css    .= 'div#cookiemessage div#themessage p.cookietext, div#cookiemessage div#ds_cookie_accept_privacy_details p.cookietext {font-family: Arial, Helvetica, sans-serif;line-height:14px;font-size12px;}';
			$css  	.= 'div#cookiemessage a {text-decoration:underline;font-weight:bold;}';
			$css 	.= 'div#ds_cookie_accept_privacy_details h1 {font-family: Arial, Helvetica, sans-serif;font-weight:bold;font-size:15px;color:#fff;line-height:16px;margin:0;margin-top:30px;padding:0;}';
			$css 	.= 'div#ds_cookie_accept_privacy_details {width:960px;text-align:left;display:none;padding-bottom:30px;margin:0 auto;}';
			$css 	.= 'div#cookiemessage .btn {text-decoration:none;display:inline-block;*display:inline;padding:4px 12px;margin-bottom:0;*margin-left:.3em;font-size:14px;line-height:20px;*line-height: 20px;color:#333333;text-align:center;text-shadow:0 1px 1px rgba(255,255,255,0.75);vertical-align:middle;cursor:pointer;background-color:#f5f5f5;*background-color:#e6e6e6;background-image:-moz-linear-gradient(top,#ffffff,#e6e6e6);background-image:-webkit-gradient(linear,0 0, 0 100%,from(#ffffff),to(#e6e6e6));background-image:-webkit-linear-gradient(top,#ffffff,#e6e6e6);background-image:-o-linear-gradient(top,#ffffff,#e6e6e6);background-image:linear-gradient(to bottom,#ffffff,#e6e6e6);background-repeat:repeat-x;border:1px solid #bbbbbb;*border: 0;border-color: #e6e6e6 #e6e6e6 #bfbfbf;border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);border-bottom-color: #a2a2a2;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffffff", endColorstr="#ffe6e6e6", GradientType=0);filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);*zoom: 1;-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);}';
			$css 	.= 'div#cookiemessage .btn:hover {color: #333333;background-color: #e6e6e6;*background-color: #d9d9d9;}';
			$css .= '</style>';
			return $css;
		}
	}

	/* REQUIRES JQUERY */
	public function jquery_javascript() {
		$accepted_cookies = $this->EE->input->cookie('ds_cookie_accept', false);
		if(!$accepted_cookies) {
			$script = '<script type="text/javascript">';
			$script 	.= '$(document).ready(function () {';
			$script 		.= '$("#ds_cookie_accept_privacy").click(function(e) {';
			$script 			.= 'e.preventDefault();';
			$script				.= '$("div#ds_cookie_accept_privacy_details").slideToggle();';
			$script 		.= '});';
			$script 		.= '$("#ds_cookie_accept").click(function(e) {';
			$script 			.= 'e.preventDefault();';
			$script 			.= '$("div#cookiemessage").fadeOut();';
			$script 			.= 'var exp___today = new Date();';
			$script 			.= 'var exp__expires_date = new Date( exp___today.getTime() + (20 * 365 * 24 * 60 * 60) );';
			$script 			.= 'document.cookie ="exp_ds_cookie_accept" + "=" + escape("set") + "';
			$script 			.= ';expires=" + exp__expires_date.toGMTString() + "';
			$script 			.= ';path=/";';
			$script 		.= '});';
			$script 	.= '});';
			$script .= '</script>';
			return $script;
		}
	}

	private function quick_debug($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	// usage instructions
	public function usage() 
	{
  		ob_start();
?>
-------------------
HOW TO USE
-------------------
NOTE: This plugin requires jquery

The simplest usage:
{exp:ds_cookie_accept:message}
Make sure this is added after jquery is loaded to your page, it depends on jquery.

To disable the inclusion of javascript in the output:
{exp:ds_cookie_accept:message include_js="no"}

This way you can output the JavaScript anywhere you want with this tag:
{exp:ds_cookie_accept:jquery_javascript}

The same applies for css:
{exp:ds_cookie_accept:css}

To use a custom message:
{exp:ds_cookie_accept:message}
CUSTOM HTML
{/exp:ds_cookie_accept:message}

And a custom title:
{exp:ds_cookie_accept:message title_text="Custom title text"}

A custom link text:
{exp:ds_cookie_accept:message link_text="Custom link text"}

Full usage:
{exp:ds_cookie_accept:css}
{exp:ds_cookie_accept:message title_text="Custom title text" link_text="Custom link text" include_js="no" include_css="no"}
CUSTOM HTML
{/exp:ds_cookie_accept:message}
{exp:ds_cookie_accept:jquery_javascript}

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}	
}
