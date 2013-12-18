top_pop_enable_hide = true;

function showHideTopPop(id, show)
{
	if (show == undefined || show == null)
	{
		show = 1;
	}

	p = document.getElementById(id);
	partner = document.getElementById('partner_li');
	pn = p.parentNode;
	w = pn.offsetWidth;

	p.style.width = w+8+'px';
	pos = getAbsolutePos(pn);

	if (show)
	{
		top_pop_enable_hide = false;
	}

	if (show && p.style.display == 'none')
	{
		p.style.display = '';
		p.style.left = pos.x+'px';
		partner.className = 'popOn';

		if ($is.IE6)
		{

//	document.getElementById('search_category').style.display = 'none';
		}
	}
	else if (!show)
	{
		top_pop_enable_hide = true;
		setTimeout('showHideTopPop_call(p,partner);',500);

		/*
		p.style.display = 'none';
		partner.className = '';

		if ($is.IE6)
		{
			//document.getElementById('search_category').style.display = '';
		}
		*/
	}
}
function showHideTopPop_call(p,partner)
{
	if (!top_pop_enable_hide)
	{
		return false;
	}
	p.style.display = 'none';
	partner.className = '';

	if ($is.IE6)
	{
		//document.getElementById('search_category').style.display = '';
	}
}

change_city_fixed_pos = false;
function showChangeCity(eThis,isnew)
{
	cs = document.getElementById('city_select');

	if (isnew)
	{
		showChangeCityNew(eThis);
		return;
	}

	if (eThis == null || eThis == undefined)
	{
		eThis = 0;
	}

	if (!eThis)
	{
		change_city_fixed_pos = true;
		cs.style.display = '';
		cs.style.left = Math.round( (screen.width/2) - (cs.offsetWidth/2))+"px";
		cs.style.top = '120px';
	}
	else
	{
		change_city_fixed_pos = false;
		pos = getAbsolutePos(eThis);
		cs.style.display = '';
		cs.style.left = pos.x+eThis.offsetWidth+10+'px';
		cs.style.top = pos.y+'px';
	}
}
function showChangeCityNew(eThis)
{
	cs = document.getElementById('city_select');

	if (eThis == null || eThis == undefined)
	{
		eThis = 0;
	}

	if (!eThis)
	{
		change_city_fixed_pos = true;
		cs.style.display = '';
		cs.style.left = Math.round( (screen.width/2) - (cs.offsetWidth/2))+"px";
		cs.style.top = '120px';
	}
	else
	{
		change_city_fixed_pos = false;
		pos = getAbsolutePos(eThis);
		cs.style.display = '';
		cs.style.left = pos.x+eThis.offsetWidth+30+'px';
		cs.style.top = pos.y+20+'px';
	}
}
function fixedChangeCity()
{
	if (!change_city_fixed_pos) return false;

	cs = document.getElementById('city_select');
	if (cs.style.display != 'none')
	{
		cs.style.top = document.body.scrollTop+120+'px';
		setTimeout('fixedChangeCity()',200);
	}
}
function hideChangeCity()
{
	cs = document.getElementById('city_select');
	cs.style.display = 'none';
}


function changeCity(city_id)
{
	/*if (document.getElementById('cart_updater1')) {document.getElementById('cart_updater1').src='/chcity.php?setprice='+city_id;}
	else {document.getElementById('cart_updater').src='/cat2.php?setprice='+city_id;}*/
	location = '/chcity.php?setprice='+city_id;
	hideChangeCity();
}

function valign_menu_buttons()
{
	els = document.getElementById('header_menu').getElementsByTagName('A');
	for (i=0; i<els.length; i++)
	{
		el = els[i];
		if (el.className == 'hmLink')
		{
			ph = el.parentNode.offsetHeight;
			h = el.offsetHeight;
			el.style.height = ph+'px';
			im = el.getElementsByTagName('IMG')[0];
			pad = (((ph-h)/2)+1);
			im.style.marginTop = pad+'px';
			//alert(pad);
		}
	}
}



function dojoInit()
{
	/*
	var node = document.createElement('div');
	node.innerHTML = dojo.byId('addGoodsFromCatalogPane').innerHTML;
	dojo.byId('addGoodsFromCatalogDock').appendChild(node);
	var tmp = new dojox.layout.FloatingPane({
		title: "Редактирование резерва",
		dockable: false,
		maxable: false,
		closable: true,
		resizable: false
	},node);
	tmp.startup();

	// Close event
	dojo.connect(tmp, 'close',
		function()
		{
			var xhrArgs =
			{
				url: "/services/gateway.php",
				handleAs: "text",
				load: function(data, ioargs)
				{
					//targetNode.innerHTML = "XHR returned HTTP status: " + ioargs.xhr.status;
				},
				error: function(error, ioargs)
				{
					//targetNode.innerHTML = "An unexpected error occurred: " + error;
				},
				content:
				{
					t: new Date().getTime(),
					method: "system.params.remove",
					params: "name:addGoodsFromCatalog;"
				}
			}

			dojo.xhrGet(xhrArgs);
			return false;
		}
	);
	*/
}







var s_text=""
function searchFieldFocus(eThis)
{
	if (eThis.value == s_text)
	{
		eThis.value = '';
	}

	eThis.className = 'sFieldActive';
}
function searchFieldBlur(eThis)
{
	if (eThis.value == '' || eThis.value == s_text)
	{
		eThis.value = s_text;
		eThis.className = 'sField';
	}
}

function searchFieldOnChange(eThis)
{
	if (eThis.value == '' || eThis.value == s_text)
	{
		eThis.value = s_text;
		eThis.className = 'sField';
	}
	else
	{
		eThis.className = 'sFieldActive';
	}
}

function categoryFieldFocus(eThis)
{
	eThis.className = 'sCategoryActive';
return true;
}

function categoryFieldBlur(eThis)
{
	if (eThis.value == 0)
	{
		eThis.className = 'sCategory';
	}
	else
	{

	}
}


function submit_login(e)
{
	if (e.keyCode == 13)
	{
		if (document.getElementById('login_form1'))
		{
			document.getElementById('login_form1').submit();
		}
		else
		{
		document.getElementById('login_form').submit();
		}
	}
}
function submit_search(e)
{
	if (e.keyCode == 13)
	{
		location = '/search.php?r='+document.getElementById('search_category').value+'&q='+document.getElementById('search_input').value;

		//document.getElementById('header_searcH_form').submit();
		return false;
	}
}

function show_hidden_filter_rows(filter_id, eThis, row_prefix)
{
	fil = document.getElementById(filter_id);
	elements = fil.getElementsByTagName('DIV');
	eval("var expr = /"+row_prefix+"/;");
	for(i=0; i<elements.length; i++)
	{
		el = elements[i];
		if (el.id.match(expr))
		{
			el.style.display = '';
		}
	}
	eThis.parentNode.style.display = 'none';
}


////////////////////////////

function get_search_tips(eThis,speek)
{
	w = eThis.value;
	if (w.length<3)
	{
		hide_search_tips(1);
		return false;
	}

	$.get('tips.php?speek='+speek,
		{ w: w},
		function(data)
		{
			if (data.length>5) // вменяемый контент пришел
			{
				document.getElementById('search_tips').style.display = '';
				document.getElementById('search_tips_cont').innerHTML = data;

				//alert(navigator.userAgent);
				if (navigator.userAgent.indexOf('MSIE') + 1)
				{
					document.getElementById('search_tips').style.width = '265px';
					document.getElementById('search_tips_cont').style.width = '262px';
					document.getElementById('search_tips').style.height = '135px';

					/*
					document.getElementById('search_tips').style.width = (document.getElementById('search_tips').offsetWidth+1)+'px';
					document.getElementById('search_tips_cont').style.width = (document.getElementById('search_tips').offsetWidth+0)+'px';
					*/
				}
				else
				{
					/*
					document.getElementById('search_tips').style.width = document.getElementById('search_input').offsetWidth+'px';
					document.getElementById('search_tips_cont').style.width = document.getElementById('search_input').offsetWidth+'px';
					*/
				}
			}
			else
			{
				hide_search_tips(1);
			}
			//alert('Load was performed.');
		});
}

enable_hide_search_tips = false;
st_timer = null;
function hide_search_tips(t)
{
	if (t==undefined || t==null)
	{
		t = 1500;
	}
	enable_hide_search_tips = true;
	st_timer = setTimeout(hide_search_tips_call, t);
}
function hide_search_tips_call()
{
	if (enable_hide_search_tips)
	{
		document.getElementById('search_tips').style.display='none';
	}
}
function show_search_tips(speek)
{
	clearTimeout(st_timer);
	enable_hide_search_tips = false;
}

function headerSearchSubmit()
{
	document.getElementById('header_searcH_form').submit();
}

//////////////////////
// Высота документа
var ua = navigator.userAgent.toLowerCase();
var isOpera = (ua.indexOf('opera')  > -1);
var isIE = (!isOpera && ua.indexOf('msie') > -1);

function getDocumentHeight() {
  return Math.max(document.compatMode != 'CSS1Compat' ? document.body.scrollHeight : document.documentElement.scrollHeight, getViewportHeight());
}

function getViewportHeight() {
  return ((document.compatMode || isIE) && !isOpera) ? (document.compatMode == 'CSS1Compat') ? document.documentElement.clientHeight : document.body.clientHeight : (document.parentWindow || document.defaultView).innerHeight;
}
function setTerminalBar() // ставит высоту терминального инфо бара
{
	h = getDocumentHeight();
	document.getElementById('terminal_bar').style.height = h+'px';
}
///////////

function dump(arr,level) {
    var dumped_text = "";
    if(!level) level = 0;
    //The padding given at the beginning of the line.
    var level_padding = "";
    for(var j=0;j<level+1;j++) level_padding += "    ";
    if(typeof(arr) == 'object') { //Array/Hashes/Objects
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') { //If it is an array,
                dumped_text += level_padding + "’" + item + "’ …\n";
                dumped_text += dump(value,level+1);
            } else {
                dumped_text += level_padding + "’" + item + "’ => \"" + value + "\"\n";
            }
        }
    } else { //Stings/Chars/Numbers etc.
        dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
    }
    return dumped_text;
}
function print_r(a)
{
	alert(dump(a));
}
///////////

images_preload = new Array();
function image_preload(src)
{
	found = false;
	for (i=0; i<images_preload.length; i++)
	{
		ind = images_preload[i].src.indexOf(src);

		if (ind >= 0)
		{
			found = true;
		}
	}

	if (!found)
	{
		pi = new Image();
		pi.src = src;
		images_preload.push(pi);
	}
}



/////////////

// убойная цена
function kp_list(offset)
{
	if (offset == undefined)
	{
		offset = kp_offset;
	}
	else
	{
		kp_offset = offset;
	}

	ci = 0;
	count = 0;
	for(var k in killing_prices)
	{
		count++;
		//alert(k+','+offset);
		if (k > offset)
		{
			ci++;
			if (ci <= 5)
			{
				kp_item = killing_prices[k];
				txt =
					'<table id="kp_tb_'+ci+'" cellpadding="0" cellspacing="0" width="100%" style="height: 100%;"><tr><td valign="top">'+
					'<div class="kpiImg"><a  href="/goods/'+kp_item['id']+'/"  onClick="if (w = window.open(\'/goods/'+kp_item['id']+'/\',\''+kp_item['id']+'\' ,\'scrollbars=1,resizable=1,toolbar=yes,menubar=yes,location=1,width='+winWidth+',height='+winHeight+',left=10,top=10,status=yes\')) { return false; }"><img src="http://fast.ulmart.ru/good_small_pics2/'+kp_item['id']+'s.jpg"></a></div>'+
					'<div class="kpiName"><a  href="/goods/'+kp_item['id']+'/"  onClick="if (w = window.open(\'/goods/'+kp_item['id']+'/\',\''+kp_item['id']+'\' ,\'scrollbars=1,resizable=1,toolbar=yes,menubar=yes,location=1,width='+winWidth+',height='+winHeight+',left=10,top=10,status=yes\')) { return false; }">купить '+kp_item['name']+'</a></div>'+
					'<table cellpadding="0" cellspacing="0"align="center"><tr><td class="kpiPrice1"><div class="cpiPrice1sub1"><div class="cpiPrice1sub2"><img src="/i/0.gif" width="1" height="1"></div>'+kp_item['start_discount_price']+'&nbsp;р.</div></td></tr></table>'+
					'<div class="kpiPrice2">'+kp_item['price']+'&nbsp;р.</div>'+
					'</td></tr><tr><td valign="bottom">'+
					'<div class="kpiBuy"><a href="#" onclick="cartIconClick2(this, '+kp_item['id']+'); AddGoods2CartOne(\'/\',\''+kp_item['id']+'\',\'\',\'\'); return false;"><img src="/i/design3/kill_price_buy.jpg"></a></div>'+
					'</td></tr></table>'
				;

				document.getElementById('kp'+ci).innerHTML = txt;
			}
		}
	}

	for (i=1; i<=5; i++)
	{
		document.getElementById('kp_tb_'+i).style.height = '100%';
	}

	if (count - offset > 5)
	{
		document.getElementById('kp_right').innerHTML =
			'<img src="/i/design3/arrow_right.jpg" style="cursor: pointer;" onClick="kp_right();">';
	}
	else
	{
		document.getElementById('kp_right').innerHTML =
			'<img src="/i/design3/arrow_right_disable.jpg">';
	}

	if (offset > 0)
	{
		document.getElementById('kp_left').innerHTML =
			'<img src="/i/design3/arrow_left.jpg" style="cursor: pointer;" onClick="kp_left();">';
	}
	else
	{
		document.getElementById('kp_left').innerHTML =
			'<img src="/i/design3/arrow_left_disable.jpg">';
	}
}
function kp_left()
{
	if (kp_offset>0)
	{
		kp_offset = kp_offset-1;
	}
	kp_list();
}
function kp_right()
{
	kp_offset = kp_offset+1;
	kp_list();
}