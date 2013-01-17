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
{exp:ds_cookie_accept:css background_color_fallback="#000000" background_color="0, 0, 0, 0,8"}
{exp:ds_cookie_accept:message title_text="Custom title text" link_text="Custom link text" include_js="no" include_css="no"}
CUSTOM HTML
{/exp:ds_cookie_accept:message}
{exp:ds_cookie_accept:jquery_javascript}