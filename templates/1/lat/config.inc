<?php
//@date_default_timezone_set($timezone);
$post_method="POST";
$allow_complex=0; //allow complex order
$allow_one=1; //allow simple order
$inbox=26; //q-ty of goods in box (column number in a database)
$box_volume=18; //box volume (column number in a database)
$user_volume=20; //user volume (column number in users.txt)
$user_pass_complex=20;//password for complex carts (column number in users.txt)
$k1=0.8; //empirical factor capacity for storage
$oficial_name="$shop_name"; //only slashed quotes inside
$oficial_adress="UK, London";
$oficial_phone="$telef";
$oficial_logo="$shop_name";
$oficial_stamp="";
$mod_rw_enable=0; //enable(1) or disable(0) mod_rewrite catalogues
//whois service
$ripe_adr="whois.ripe.net";
$ripe_port=43;
$ripe_timeout=5;
if (!isset($_SESSION["user_currency"])){ $okr=$currencies_round[$defvalut]; } else { $okr=$currencies_round[$_SESSION["user_currency"]]; }

$zak_po="Pas&#363;t&#299;t pa telefonu no <b>11:00</b> l&#299;dz <b>18:00</b>";

$dost_naim1="<br><small>Preces pieg&#257;de cena maz&#257;k k&#257;  ";

$dost_naim2="<br><small>Preces pieg&#257;de ir BEZMAKSAS, ja pas&#363;t&#299;juma summa ir vair&#257;k nek&#257; ";

$lang = array (

'poluchatel'=>"JSC XXXXXXX",
'bank'=>"VT Bank",
'rs'=>"40802810518000000000",
'ks'=>"40802810518000000001",
'bik'=>"044525000",
'mainsite'=>"Galven&#257;",
'webshop'=>"Veikals",
'prebuy'=>"Uz pas&#363;t&#299;jumu",
'buy'=>"Pirkt",
'root_directory'=>"Galven&#257; direktorija",
'back_to_higher_level'=>"Atgriezties uz l&#299;meni augst&#257;k",

'sort_by'=>"Sort&#275;t",

'by_name'=>"p&#275;c v&#257;rda",

'by_price'=>"p&#275;c cenas",

'by_date'=>"p&#275;c datuma",

'by_pcs'=>"p&#275;c noliktavas daudzuma",

'down'=>"augoš&#257; sec&#299;b&#257;",

'up'=>"dilstoš&#257; sec&#299;b&#257;",

'addition'=>"S&#299;k&#257;k",

'click'=>"Nospiediet papildus inform&#257;cijai.",

'file'=>"Prece",

'no_foto'=>"Nav bildes",

'no_description'=>"Nav apraksta",

'description'=>"apraksts",

'exists'=>"eksist&#275;",

'not_exists'=>"neeksist&#275;",

'already'=>"jau",

'hack'=>"M&#275;&#291;ini uzlauzt?<br><br>Tas ir aizliegts!",
'to_admin'=>"Griezieties pie administr&#257;tora",
'html_tags'=>"HTML tegi",
'enter'=>"Ieeja tikai piere&#291;istr&#275;tiem lietot&#257;jiem",
'login'=>"Login",
'pass'=>"Parole",
'del'=>"Dz&#275;st",
'clear'=>"Izt&#299;r&#299;t",

'edits'=>"Labot",

'undo'=>"Atcelt",

'sendform'=>"S&#363;t&#299;t",

'search'=>"Mekl&#275;t",

'query'=>"Ievadiet atsl&#275;gv&#257;rdus",

'back'=>"Atgriezties",

'file_list'=>"Atrast&#257;s preces",

'keyword'=>"Atsl&#275;gv&#257;rds",

'indexator'=>"L&#363;dzu pagaidiet! Notiek indeks&#257;cija",

'last_index'=>"P&#275;d&#275;j&#257;s indeks&#257;cijas datums",

'total'=>"Visp&#257;r objektu:",

'total_dirs'=>", kategorijas:",

'total_files'=>", preces:",

'index_ok'=>"Indeks&#257;cija veiksm&#299;gi pabeigta.",

'index'=>"Arh&#299;va indeks&#257;cija",

'creation'=>"Izveidošana",

'pcs'=>"gb.",

'qty'=>"Daudzums",

'price'=>"Cena",

'info'=>"Prece",

'subtotal'=>"Kopums",

'id'=>"ID",

'exit'=>"Izeja",

'ch'=>"Izmain&#299;t",

'welc'=>"Sveicin&#257;ti",

'thnk'=>"Paldies par apmekl&#275;jumu",

'yourstat'=>"J&#363;su status:",

'adm1'=>"Nodal&#299;jumu indeks&#257;cija",

'adm2'=>"Preèu administr&#257;tors",

'adm3'=>"CMS",

'adm4'=>"Pas&#363;t&#299;jumi",

'adm5'=>"Lietot&#257;ji",

'adm6'=>"Foruma administr&#257;tors",

'adm7'=>"Noform&#275;juma šablons",

'adm8'=>"Valodas šablons",

'adm9'=>"Galvenais šablons",

'adm10'=>"Parole uz /ADMIN",

'adm11'=>"Teksta indeks&#257;cija",

'buyes'=>"Pirkts:",

'all_items'=>"Preces:",

'edit_templates'=>"Šablonu redi&#291;&#275;šana",

'list_templates'=>"Šablonu saraksts:",

'regtext'=>"P&#275;c re&#291;istr&#257;cijas J&#363;s ieet veikal&#257; zem sava lietot&#257;jv&#257;rda un J&#363;s

b&#363;siet atbr&#299;vots no garlaic&#299;go formu aizpild&#299;šanas n&#257;kam&#257;j&#257;s reiz&#275;s. Tikai

piere&#291;istr&#275;tite lietot&#257;ji var dab&#363;t speci&#257;los bonusus un atlaides.",

'themes'=>"Šablons/Skin:",



1=>"Apkalpošana",

2=>"Prece p&#275;c foto",

3=>"Saglab&#257;t b&#257;zi",

4=>"Savs MENU",

5=>"Mekl&#275;šana&Aizvietošana",

6=>"Katalogu bildes",

7=>"Veikals",

8=>"Komment&#257;riji",

9=>"Forums",

10=>"Šabloni",

11=>"Saita kr&#257;sas",

12=>"Svar&#299;gi",

13=>"Statistika",

14=>"Ban&#275;tie",

15=>"Statistikas dz&#275;šana",

16=>"Noliktavas indeks&#257;cija",

17=>"Noliktavas analitika",

18=>"Centr&#257;l&#257; noliktava",

19=>"Rekl&#257;ma",

20=>"V&#275;stu&#316;u s&#363;t&#299;šana",

21=>"Linku lapa",

22=>"Formu redi&#291;&#275;šana",

23=>"D/Katalogu &#291;ener&#257;tors",

24=>"Serveru apmai&#326;a",

25=>"Uzst&#257;d&#299;šana",

26=>"Palaist",

27=>"Preèu import&#275;šana no citas b&#257;zes",

28=>"Papildus",

29=>"Dz&#275;st visas preces",

30=>"Pieeja at&#316;auta",

31=>"Grozs",

32=>"Preces",

33=>"Summa",

34=>"Kop&#257;",

35=>"J&#363;su pirkumi",

36=>"J&#363;su login",

37=>"J&#363;su login j&#257;satur at&#316;autie simboli (burti, cipari, _ - z&#299;me) un b&#363;t ne

naz&#257;k k&#257; 3 smboli un ne gar&#257;k k&#257; 12 simboli!",

38=>"J&#363;su parolei j&#257;satur at&#316;autie simboli (burti, cipari, _ - z&#299;me) un b&#363;t ne

naz&#257;k k&#257; 3 smboli un ne gar&#257;k k&#257; 12 simboli!",

39=>"Re&#291;istr&#257;cija",

40=>"Grozs ir tukšs",

41=>"Pas&#363;t&#299;jums nav iesp&#275;jams",

42=>"K&#316;&#363;da",

43=>"J&#363;su pas&#363;t&#299;jums pie&#326;emts un aizs&#363;t&#299;ts menedžerim",

44=>"Faila atv&#275;ršanas k&#316;&#363;da",

45=>"pie ierakst&#299;šanas",

46=>"Pal&#299;dz&#299;ba",

47=>"Price",

48=>"Jaunajiem lietot&#257;jiem",

49=>"L&#363;dzu",

50=>"Piere&#291;istr&#275;jieties",



52=>"lai saglab&#257;t J&#363;su personas datus",

53=>"J&#363;su personas dati",

54=>"Kontakti",

55=>"Par mums",

56=>"Jaunumi",

57=>"Licences piepras&#299;jums",

58=>" aizs&#363;t&#299;ts!Gaidiet v&#275;stuli ar licenz&#275;tu kodu.",

59=>"Noform&#275;t",

60=>"Administr&#275;šana",



61=>"Metropolitens",

62=>"Ja J&#363;s pas&#363;tat preci, kas ir p&#275;c izm&#275;ra, tad l&#363;dzu nor&#257;diet Jums vajadz&#299;go

izm&#275;ru.",

63=>"V&#275;lams pierakst&#299;t k&#257; piebraukt kurjeram",

64=>"St&#257;vs",

65=>"Dz&#299;vok&#316;a nummurs",

66=>"Piebrauktuve",

67=>"Korpuss",

68=>"M&#257;jas nummurs",

69=>"Domofons",

70=>"J&#363;s neesat nor&#257;d&#299;jis/usi",

71=>"Iela",

72=>"Pils&#275;ta",

73=>"T&#257;lrunis",

74=>"J&#363;su V&#257;rds",

75=>"V&#257;rds uzv&#257;rds",

76=>"Aizsegv&#257;rds",

77=>"Pas&#363;t&#299;tajs",

78=>"Apkalpojam tikai R&#299;g&#257;",

79=>"Nor&#257;diet, ja nav sarakst&#257;",

80=>"ES PIEKR&#298;TU, Man&#275;j&#257; piekrišana noz&#299;m&#275;, ka es pie&#326;emu veikala (sk. zem&#257;k)

nosac&#299;jumus un uz&#326;emos tos ietur&#275;t.",

81=>"Oblig&#257;tie aizpild&#299;šanas lauki",

82=>"P&#275;c š&#299;s pogas uzspiešanas, j&#363;s aizû&#363;t&#299;siet pieteikumu m&#363;su menedžerim, kurš

ar jums sazin&#257;sies, darba laik&#257;, pas&#363;t&#299;juma un pieg&#257;des datuma un laika

defin&#275;šanas apstiprin&#257;jumam. T&#257;pat uz J&#363;su E-mail b&#363;s izs&#363;t&#299;ta dot&#257; pas&#363;t&#299;juma

kopija.",



83=>"Ievadiet skaitli, kuru redzat bild&#275;",

84=>"Tas ir vajadz&#299;gs c&#299;&#326;ai pret spamu",

85=>"Zi&#326;a",

86=>"Aizmirsi paroli?",

87=>"Aizmirst&#257;s paroles atjaunošanai ievediet elektroniska pasta adresi, ko J&#363;s

nor&#257;d&#299;j&#257;t re&#291;istr&#257;cij&#257;",

88=>"Lietot&#257;ja paroles atjaunošana",

89=>"P&#275;c pareizas adreses ievades, sist&#275;ma izdos zi&#326;u par dot&#257;s oper&#257;cijas

pan&#257;kumiem.",

90=>"Aizs&#363;t&#299;t paroli",

91=>"Dotais e-mail nav piere&#291;istr&#275;ts sist&#275;m&#257;. Nor&#257;diet pareizu e-mail.",

92=>"Parole ir veiksm&#299;gi aizs&#363;t&#299;ta Jums uz E-mail. J&#363;s sa&#326;emsiet to p&#275;c 5

min&#363;tem.<br>

P&#257;rbaudiet J&#363;su E-mail un izmantojiet izs&#363;t&#299;tos datus ieejai sist&#275;m&#257;.",

93=>"T&#257;das preces nav atrastas",

94=>"Nav atrasts",



95=>"Kr&#257;sa: ",

96=>"",



97=>"Pievienot favor&#299;tiem",

98=>"Padar&#299;t par starta lapu",

99=>"no",

100=>"l&#299;dz",

101=>"Jebkura",

102=>"Cena",

103=>"Mekl&#275;t šaj&#257; nodal&#299;jum&#257;",

104=>"P&#257;reja pa lap&#257;m:",

105=>"Lapas",

'name'=>"Nosaukums",

106=>"Versija print&#275;šanai",

107=>"Izv&#275;lieties sev login",

108=>"J&#363;su dati",

109=>"Izv&#275;lieties sev paroli",

110=>"Aizmirs&#257;t login vai paroli?",

111=>"Ja J&#363;s jau esat çiere&#291;istr&#275;ti un aizmirs&#257;t loginu(paroli) J&#363;s varat

atjaunot savus datus.",

112=>"Paroles apstiprin&#257;jums",

'citys'=>"R&#299;ga",

'choose'=>"Izv&#275;lieties",

113=>"Lietot&#257;js ar š&#257;du login jau eksist&#275;, izv&#275;lieties citu login.",



114=>"Šodien",

115=>"Janv&#257;ris",

116=>"Febru&#257;ris",

117=>"Marts",

118=>"Apr&#299;lis",

119=>"Maijs",

120=>"J&#363;nijs",

121=>"J&#363;lijs",

122=>"Augusts",

123=>"Septembris",

124=>"Oktobris",

125=>"Novembris",

126=>"Decembris",



127=>"Favor&#299;ti",



128=>"Atlaides prec&#275;m",

129=>"Diska izt&#299;r&#299;šana",

130=>"Dublik&#257;tu mekl&#275;šana",

131=>"TOP 10 indeks&#257;cija",

132=>"Mekl&#275;šanas tegu redakcija",

133=>"Tegu indeks&#257;cija",

134=>"Kv&#299;ts forma",

135=>"Galvenie parametri",

136=>"Grafisko šablonu redaktors",



137=>"Uztais&#299;t preces kopiju",

138=>"Papildus foto",

139=>"Palielin&#257;t foto",

140=>"Uzspiediet uz foto, lai palielin&#257;t",

141=>"Atrasts p&#275;c atsl&#275;gv&#257;rda",



142=>"Pas&#363;t&#299;juma noform&#275;šana",

143=>"Noform&#275;šanas s&#257;kuma laiks",

144=>"Kompleks&#257; pas&#363;t&#299;juma noform&#275;šana",



'Sun'=>"Sv&#275;tdiena",

'Mon'=>"Pirmdiena",

'Tue'=>"Otrdiena",

'Wed'=>"Trešdiena",

'Thu'=>"Ceturtdiena",

'Fri'=>"Piektdiena",

'Sat'=>"Sestdiena",



145=>"Pas&#363;t&#299;t",

146=>"J&#363;s nepareizi ievad&#299;j&#257;t kontrolskaitli",

147=>"J&#363;s neesat piekrituši Veikala Nosac&#299;jumiem. Pas&#363;t&#299;jums neb&#363;s noform&#275;ts.",



148=>"Vairumcena",

149=>"Mazumcena",



150=>"J&#363;s nor&#257;d&#299;j&#257;t nepareizo Email",

151=>"Nav atrasts \"@\" simbols.",

152=>"Simbols \"@\" nevar b&#363;t Email s&#257;kum&#257;.",

153=>"Simbols \"@\" nevar b&#363;t Email beig&#257;s.",

154=>"Error Email.",

155=>"Dom&#275;ns nav zin&#257;ms. Pasta s&#363;t&#299;šana ir at&#316;auta tikai uz dom&#275;niem:",

156=>"Pieg&#257;des adrese",



157=>"Pils&#275;tas kods:",

158=>"Nosaukums",

159=>"Pils&#275;tas telefonkods",

160=>"Apmaksas veids",

161=>"Pieg&#257;des veids",

162=>"n&#257;kam&#257;",

163=>"iepriekš&#275;j&#257;",

164=>"s&#257;kums",

165=>"Iev&#275;rojot pieg&#257;di un apmaksas veidu",

166=>"BEZMAKSAS",



167=>"Valsts",

168=>"J&#363;s izmantoj&#257;t aizliegtos simbolus lauk&#257;",

169=>"Person&#299;g&#257; tips",

170=>"Noliktava",

171=>"Popul&#257;rie tegi",

172=>"Jaunums",



173=>"Atrasts centr&#257;l&#257; noliktav&#257;",

174=>"noliktav&#257;:",

175=>"preces nav",

176=>"J&#363;su cena",

177=>"J&#363;s jau ierakst&#299;j&#257;t šo koment&#257;riju",

178=>"Linku rakst&#299;šana koment&#257;rijos - stingri aizliegta",

179=>"Jums nav ties&#299;bu rakst&#299;t koment&#257;rijus!",

180=>"J&#363;s b&#363;siet pirmais, kas atst&#257;s savu atsauksmi!",

181=>"Koment&#257;riji nodz&#275;sti",

182=>"Koment&#257;riji izmain&#299;ti.",

183=>"Koment&#257;riju labošana:",

184=>"Tikai administr&#257;toriem",

185=>"Dz&#275;st visus koment&#257;rijus",

186=>"Banot IP",

187=>"Sp&#275;l&#275;t visu",

188=>"nav foto",

189=>"max: 1000 simb.",

190=>"max: 50 simb.",

191=>"Teksts:",

192=>"Atst&#257;jiet J&#363;su uzskatu par preci:",

193=>"Viesis",

194=>"Citas preces no kolekcijas",

195=>"Mekl&#275;t",

196=>"Kr&#257;sa",

197=>"Materi&#257;ls",

198=>"Tagad p&#257;rdošan&#257;",

199=>"Apskat&#299;ts",

200=>"Pirc&#275;ju atsauksmes",

201=>"Visa prece",

202=>"Prece nav atrasta",



203=>"Lapu:",

204=>"Par&#257;d&#299;ti no",

205=>"pa",

206=>"Kop&#257;:",

207=>"poz&#299;ciju",

208=>"Veiksm&#299;gi pievienots grozam.",

209=>"Veiksm&#299;gi!",

210=>"Preces pievienošana grozam neizdevusies",

211=>"Uzman&#299;bu!",

212=>"Jums ir nenoform&#275;ts grozs",

213=>"No t&#257;s dienas šo preèu cena, atlaides un p&#257;r&#275;jais var&#275;ja izmain&#299;ties.

Prece var&#275;ja b&#363;t nov&#257;kta no p&#257;rdošanas. J&#363;s varat m&#275;&#291;in&#257;t p&#257;rlikt to j&#363;su

tekošaj&#257; groz&#257; (iev&#275;rojot tekoš&#257;s cenas) vai no jauna pas&#363;t&#299;t preci.",

214=>"Izskat&#299;t saturu",

215=>"k&#257;rbu ",

216=>"Ir pas&#363;t&#299;ts vair&#257;k nek&#257; ielien k&#257;rb&#257;",

217=>"Summa",

218=>"porciju",

219=>"cena nor&#257;d&#299;ta ar atlaidi",

220=>"At&#316;autas tikai sekojoš&#257;s z&#299;mes:",

221=>"Bez virsraksta",

222=>"nav p&#257;rdošan&#257;, un netiks pievienots grozam!",

223=>"Iesp&#275;jams prece tika p&#257;rsaukta vai ir izmain&#299;jies t&#257;s kods.",

224=>"Kast&#275;:",

225=>"Palielin&#257;t l&#299;dz tuv&#257;kai veselai kastei",

226=>"Samazin&#257;t l&#299;dz tuv&#257;kai veselai kastei",

227=>"J&#363;su pas&#363;t&#299;jumu satur neveselu kast&#299;šu daudzumu.<br>

Izmainiet savu pas&#363;t&#299;jumu l&#299;dz veselam kast&#299;šu daudzumam.",

228=>"Pas&#363;t&#299;jums nav piln&#299;b&#257; redi&#291;&#275;ts. Redi&#291;&#275;jiet pas&#363;t&#299;jumu piln&#299;b&#257;, lai katrs

produkta nosaukums novietotos Vesel&#257; kast&#299;šu daudzum&#257; (sk. zem&#257;k).",

229=>"porciju",

230=>"Pa&#326;emiet v&#275;l",

231=>"vai no&#326;emiet",

232=>"vai nodz&#275;siet rindu nospiežot [x] pogu",



233=>"atlaide!",

234=>"Cien&#299;jamie VIP-klienti, kas sa&#326;&#275;ma m&#363;su atlaides karti!",

235=>"Visas cenas veikal&#257; - autom&#257;tiski p&#257;rr&#275;&#311;in&#257;j&#257;s iev&#275;rojot atlaidi.

Saform&#275;jot pas&#363;t&#299;jumu ievadiet savus datus pieg&#257;des form&#257;, kura par&#257;d&#299;sies pie

pas&#363;t&#299;juma noform&#275;juma.",

236=>"Specpied&#257;v&#257;jumi:",

237=>"Dz&#275;st visus specpied&#257;v&#257;jumus",

238=>"Uzspiediet šeit ja J&#363;s esat piere&#291;istr&#275;ts, bet neatceraties savus uzskaišu

datus",

239=>"P&#275;d&#275;jo piecu pas&#363;t&#299;jumu saraksts:",

240=>"Kompleksais pas&#363;t&#299;jums",

241=>"Br&#299;din&#257;jums!",

242=>"&#298;st&#257; moment&#257; viens no J&#363;su komp&#257;nijas str&#257;dniekiem, atbildošs par

kompleksveida pas&#363;t&#299;juma gal&#299;gu noform&#275;jumu uzs&#257;ka fin&#257;lf&#257;zi - pieteikuma

noform&#275;jumu.<br>

Ja J&#363;s gribat steidzami papildin&#257;t jau saform&#275;to pas&#363;t&#299;jumu v&#275;ršaties pie š&#257;

str&#257;dnieka ar l&#363;gumu atdot pas&#363;t&#299;jumu uz redakcijas stadiju.<br>

Cit&#257;di Jums b&#363;s nepieciešams noform&#275;t citu pas&#363;t&#299;jumu.",

243=>"Nav apstr&#257;d&#257;ts",

244=>"Pas&#363;t&#299;jums",

245=>"Pirms komples&#257; pas&#363;t&#299;jums ir nepiciešams att&#299;r&#299;t grozu.",

246=>"P&#275;c t&#257; - J&#363;su brouzeris ir j&#257;p&#257;rce&#316; J&#363;s uz kompleksveida pas&#363;t&#299;juma

noform&#275;juma lapaspusi.<br>

Ja tas nenotika, uzspiediet uz",

247=>"linku",

248=>"Izv&#275;laties nodal&#299;jumu specpiedav&#257;jumiem:",

249=>"Visos nodal&#299;jumos",

250=>"Specpid&#257;v&#257;jumi nodz&#275;sti:",

251=>"Specpied&#257;v&#257;jumu faili nav atrasti!",

252=>"Fails nav atrasts:",

253=>"Iepriekš&#275;j&#257;, nepas&#363;t&#299;t&#257; pas&#363;t&#299;juma saturs",

254=>"izt&#299;r&#299;ts",

255=>"Pievienot poz&#299;cijas grozam",

256=>"Šis saturs tiks autom&#257;tiski att&#299;r&#299;ts pie J&#363;su jaunajiem pirkumiem",

257=>"Faila dz&#275;šana",

258=>"Rad&#299;t speci&#257;lspied&#257;v&#257;jumu",

259=>"Jaunumi",

260=>"Jauna inform&#257;cija sait&#257;:",

261=>"Lietot&#257;ja aktiviz&#275;šana",

262=>"Tagad J&#363;s varat ievest nor&#257;d&#299;tos v&#275;stul&#275; login un paroli, ieejai veikal&#257;.

P&#275;c tam sist&#275;ma J&#363;s iegaum&#275;s un J&#363;s tiksiet atbr&#299;voti no nepieciešam&#299;bas rakst&#299;t

kontaktu inform&#257;ciju un pieg&#257;des adresi ikreiz pie pas&#363;t&#299;juma, k&#257; ar&#299; sa&#326;emt

autom&#257;tiski atlaides pie atk&#257;rtotajiem pas&#363;t&#299;jumiem!",

263=>"Lietot&#257;ja aktiv&#257;cija ir veiksm&#299;ga!",

264=>"Lietot&#257;js jau tika aktiviz&#275;ts!<br>

Atk&#257;rtot&#257; aktiviz&#257;cija ir neiesp&#275;jama.",

265=>"Jums ir nepietiekami ties&#299;bu, lai administr&#275;tu forumu.",

266=>"No J&#363;su v&#257;rda tika izdar&#299;ts paroles atjaunošasnas piepras&#299;jums uz saita",

267=>"Ieejai izmantojiet sekojošos datus:",

268=>"Neatbildiet uz doto v&#275;stuli!",

269=>"Ja J&#363;s dom&#257;jat, ka dot&#257; v&#275;stule non&#257;ca pie Jums k&#316;&#363;das p&#275;c, l&#363;dzu,

nodz&#275;siet to un sazinieties ar saita administratoru.",

270=>"Ar vislab&#257;kajiem nov&#275;l&#275;jumiem, ",

271=>"Veikala modulis nav licenc&#275;ts!",

272=>"J&#363;s varat iek&#316;aut šo moduli, nop&#275;rkot licenci.",

273=>"J&#363;s jau skat&#299;j&#257;ties",

274=>"TOP 10 p&#275;c skat&#299;jumiem",

275=>"Bez šablona",

276=>"Galvenais specpied&#257;v&#257;jums",

277=>"Jaun&#257; cena",

278=>"Vec&#257; cena",

279=>"Ja J&#363;s main&#257;t preces daudzumu groz&#257; - tad p&#275;c pabeigšanas uzspiediet pogu

P&#257;rr&#275;&#311;in&#257;t!",

280=>"Lapas &#291;ener&#275;šanas laiks:",

281=>"Unik&#257;ls kods:",



282=>"Nodal&#299;jumu izvades k&#257;rt&#299;ba",

283=>"LICENCES IEVADE",



284=>"Jaunumu arh&#299;vs",



286=>"Vispopul&#257;r&#257;k&#257; aizz&#299;me",

287=>"Piepras&#299;jumu daudzums",

288=>"Izv&#275;laties uzrunu:",



289=>"T&#257;l&#257;k",

290=>"Noform&#275;t bez re&#291;istr&#257;cijas",

291=>"Metro sh&#275;ma",

292=>"Gatavs",

293=>"",

294=>"Ir izmain&#299;jusies cena no J&#363;su p&#275;d&#275;j&#257;s apmekl&#275;šanas dienas.",

295=>"Bija:",

296=>"Tagad:",

297=>"Prece ir ielikta groz&#257; pa jaunu cenu.",



298=>"Parole un paroles apstiprin&#257;jums - nesakr&#299;t",

299=>"K&#316;&#363;da pie datu ievades",

300=>"Simbola izmantošana",

301=>"lauk&#257;",

302=>"nepie&#316;aujami",

303=>"Vair&#257;k nek&#257; viena simbola izmantošana",

304=>" vai izmantoj&#257;t aizliegtos simbolus. At&#316;auta krievu un lat&#299;&#326;u alfab&#275;ta

burtu izmantošana.",

305=>"J&#363;s nor&#257;d&#299;j&#257;t atsauci uz citu saitu, tas ir aizliegts",

306=>"Zi&#326;a ir tukša vai to apgrieza cenz&#363;ra. T&#257; netiks aizs&#363;t&#299;ta.",

307=>"J&#363;s varat nos&#363;t&#299;t mums zi&#326;u:",

308=>"atrasts sagad&#299;šanos:",

309=>"Atrasts tekst&#257;:",

310=>"Piepras&#299;jums",

311=>"atrasts",

312=>"V&#257;rda garumam piepras&#299;jum&#257; j&#257;b&#363;t vair&#257;k k&#257; 2 simboli un var satur&#275;t tikai

krievu vai lat&#299;&#326;u burtus, k&#257; ar&#299; punktus un ciparus!",



313=>"J&#363;su groz&#257; ir prece cit&#257; val&#363;t&#257;, nek&#257; tai precei, kuru J&#363;s m&#275;&#291;in&#257;j&#257;t tikko

nopirkt.<br>

Bival&#363;t&#257;s oper&#257;cijas neatbalst&#257;s - izv&#275;laties preces vien&#257; val&#363;t&#257;.

Lai &#326;emtu tom&#275;r šo preci - Jums s&#257;kum&#257; ir",

314=>"J&#257;att&#299;ra grozs",

315=>"Tikai p&#275;c tam doto preci var&#275;s nolikt groz&#257;. Groz&#257; var likt preces tikai

vien&#257; val&#363;t&#257;.",

316=>"J&#363;su groz&#257; ir prece cit&#257; val&#363;t&#257;, kas ir atš&#311;iras no prec&#275;m šaj&#257;

nodal&#299;jum&#257;, t&#257;d&#275;&#316; ir neiesp&#275;jami apr&#275;&#311;in&#257;t pieg&#257;des v&#275;rt&#299;bu. L&#363;dzu p&#257;rejiet

veikala nodal&#299;jum&#257;, kur preces ir nor&#257;d&#299;tas taj&#257; paš&#257; val&#363;t&#257;.",



317=>"Sekm&#299;gi izmain&#299;ts",

318=>"Šablona izmai&#326;as iekš te&#291;iem",

319=>"var atvest pie neparedzamiem rezult&#257;tiem",

320=>"Šablona saturs",

321=>"Piesl&#275;gšana pie internet-veikala datu b&#257;zes",



322=>"Atjaunot b&#257;zi",

323=>"Paldies",

324=>"J&#363;su zi&#326;a ir nos&#363;t&#299;ta",

325=>"M&#275;s m&#275;&#291;in&#257;sin risin&#257;t J&#363;su jaut&#257;jumu",

326=>"J&#363;su pas&#363;t&#299;jums ir aizs&#363;t&#299;ts",

327=>"Jums p&#257;rzvan&#299;s pa nor&#257;d&#299;to t&#257;lru&#326;a nummuru pas&#363;t&#299;juma apstiprin&#257;jumam.",

328=>"J&#363;s padev&#257;t pieteikumu uz re&#291;istr&#257;ciju.",

329=>"Lai pabeigtu re&#291;istr&#257;ciju Jums ir j&#257;uzspiež n&#257;kamais links",

330=>"Aktiviz&#275;t uzskaišu ierakstu tagad",

331=>"P&#275;c aktiviz&#257;cijas J&#363;s var&#275;siet ieiet m&#363;su veikal&#257; izmantojot n&#257;kamos

datus",

332=>"Paldies! J&#363;s rad&#299;j&#257;t jaunu tematu uz foruma!",

333=>"Paldies! J&#363;su atbilde ir novietota forum&#257;!",

334=>"J&#363;s izmantoj&#257;t aizliegtos tegus temat&#257; vai zi&#326;&#257;!",

335=>"Tagad J&#363;s b&#363;siet p&#257;rs&#363;t&#299;ti pie foruma t&#275;mu saraksta.",

336=>"Ja tas nenotiks 2 sekunžu laik&#257;, J&#363;s varat uzspiest šo ",



337=>"Re&#291;istr&#257;cijas datums",

338=>"Email nevar s&#257;kties ar punktu",

339=>"Punkts nevar sekot uzreiz aiz simbola",

340=>"Nepietiek punkta p&#275;c simbola",

341=>"Email nevar beigties ar pinktu",

342=>"L&#363;dzu nedz&#275;siet šo v&#275;stuli, t&#257; var noder&#275;t!",

343=>"Paldies par re&#291;istr&#257;ciju.",

344=>"J&#363;s varat ieiet m&#363;s veikal&#257; izmantojot sekojošos datus.",

345=>"Uz nor&#257;d&#299;to E-mail aizs&#363;t&#299;ta v&#275;stule ar linku, uzspiežot uz kuru J&#363;s

apstiprin&#257;siet savu re&#291;istr&#257;ciju.",

346=>"Pieteikums ir pie&#326;emts.",

347=>"Nol&#299;gums",

348=>"J&#363;s pas&#363;t&#299;j&#257;t:",

349=>"Visp&#257;r poz&#299;ciju:",

350=>"Kop&#299;gs gabalu daudzums:",

351=>"Prece SA&#325;EMTA, ar nosac&#299;jumiem iepazinos, NAV nek&#257;du PRETENZIJU:",

352=>"Uz J&#363;su E-mail ir aizs&#363;t&#299;ta zi&#326;a ar J&#363;su pas&#363;t&#299;jumu.",

353=>"V&#275;stules kods:",

354=>"Invoiss sekm&#299;gi uztais&#299;ts",



355=>"Brendi:",

'recalc'=>"P&#257;rskait&#299;t",

'add'=>"Pievienot",

356=>"Pievienot t&#275;mu",

357=>"J&#363;su v&#257;rds",

358=>"T&#275;mas nosaukums",

359=>"Atbild&#275;t",

360=>"L&#363;dzu ievadiet t&#275;mas nosaukumu!",

361=>"L&#363;dzu ievadiet v&#257;rdu",

362=>"Ievadiet zi&#326;u",

363=>"Autors",

364=>"T&#275;mas apraksts",

365=>"Atbildes",

366=>"P&#275;d&#275;j&#257; zi&#326;a",



367=>"Izveidot t&#275;mu",

368=>"T&#275;ma",

369=>"J&#363;s neesat izveidojuši t&#275;mu forum&#257;!",

370=>"J&#363;su atbilde nav pievienota forum&#257;!",

371=>"Datums",

372=>"Darb&#299;bas",

373=>"T&#275;ma dz&#275;sta",

374=>"Atbilde dz&#275;sta",

375=>"Administr&#257;tora ieeja:",

376=>"J&#363;s esat sekm&#299;gi autoriz&#275;jušies",

377=>"Nepareizs login, vai parole!",

378=>"J&#363;s esat sekm&#299;gi ielogojušies!",

379=>"Izeja no foruma administr&#275;šanas rež&#299;ma",



380=>"Personisks kabinets",

381=>"Lietot&#257;js ar š&#257;du login jau eksist&#275;.",

'weight'=>"Svars",

'subtotalweight'=>"Kop&#299;gs svars",

'totalweight'=>"Piln&#299;gs svars",
'volume'=>"Pack volume",
'subtotalvolume'=>"Subtotal pack volume",
'totalvolume'=>"Total pack volume",

'delivery'=>"Apmaksa un pieg&#257;de",



382=>"Nodal&#299;jumu redaktors.",

383=>"Dz&#275;st failu",

384=>"Pievienot nodal&#299;jumu",

385=>"Redi&#291;&#275;t failu",

386=>"Pagaidam nosl&#275;pt.",

387=>"Atjaunot failu.",

388=>"Nosl&#275;pt failu.",

389=>"Nokop&#275;t bufer&#299;.",

390=>"P&#257;rsaukt.",

391=>"Dz&#275;st lietot&#257;ju.",

392=>"Ieeja zem š&#299; v&#257;rda.",

393=>"Nav pieejams.",

394=>"Lietot&#257;ja dz&#275;šana atved&#299;s pie vi&#326;a ieejas neiesp&#275;jam&#299;bas un vi&#326;a datu

izn&#299;cin&#257;šanas!",

395=>"Lietot&#257;ja person&#299;gi dati.",

396=>"Lietot&#257;ja tips.",

397=>"Statuss",

398=>"Lietot&#257;ji nav atrasti.",

399=>"Pie&#326;emt jaunos lietot&#257;jus",

400=>"Špikeris",

401=>"jaunie lietot&#257;ji, pagaidam pie&#326;emti galvenaj&#257; b&#257;z&#275; (users.txt)",

402=>"lietot&#257;ji, kas ir re&#291;istr&#275;ti atseviš&#311;os failos (userstat/userlogin.txt)",

403=>"lietot&#257;ji, kuriem ir ties&#299;bas redi&#291;&#275;t forumu un internetveikalu",

404=>"lietot&#257;ji kuriem ir da&#316;&#275;j&#257;s ties&#299;bas",

405=>"lietot&#257;ji, kuriem ir pieeja las&#299;t adminrež&#299;mu [Opcija uz doto br&#299;di

nestr&#257;d&#257;]",

406=>"lietot&#257;ji kuriem ir pieejamas vairumcenas",

407=>"parastie lietot&#257;ji",

408=>"Piln&#299;b&#257; kontrol&#275;t lietot&#257;jus var tikai lietot&#257;ji ar ADMIN statusu

Lietot&#257;ji ar MODER statusu var piesavin&#257;ties statusus USER, DEMO un VIP

Lietot&#257;jiem ar MODER statusu ir ties&#299;bas vald&#299;t visu lietot&#257;ju inform&#257;ciju,

iz&#326;&#275;mot ADMIN un MODER",

409=>"Lietot&#257;ja pas&#363;t&#299;jumi nav atrasti.",

410=>"P&#275;d&#275;jie jaunumi nodal&#299;jum&#257;",

411=>"24/7 online",

412=>"Admin",

413=>"J&#363;s varat jaut&#257;t jebkuru jaut&#257;jumu, jebkur&#257; t&#275;m&#257; m&#363;su konsultantam.",

414=>"Konsultants",

415=>"Nepaz&#299;stamie jaut&#257;jumi",

416=>"Sarunu tests",



417=>"Citi", //other brands<br>

418=>"Arh&#299;vs",

//name of category not viewed in items list<br>

419=>"Preces kods",

420=>"Viss",

421=>"Foto",

422=>"R&#257;d&#299;t visu",

423=>"Parastais skats.",

424=>"Paplašin&#257;ts skats.",

425=>"Tabula",

426=>"Skats",

427=>"P&#257;rdošana",

428=>"Aizv&#275;rt logu",

429=>"Nevaru izveidot vair&#257;k k&#257; 99999 preèu. V&#275;ršaties pie izgatavot&#257;ja.",

430=>"Nodal&#299;jums.",

431=>"ZemNodal&#299;jums.",

432=>"Prece veiksm&#299;gi kop&#275;ta",

433=>"Vai J&#363;s tieš&#257;m gribat izveidot preces kopiju?",

'yes'=>"J&#257;",

'no'=>"N&#275;",

434=>"Prece ar š&#245; id jau eksist&#275;!",

435=>"Nor&#257;diet jaunu preces nosaukumu un jaunu preces kodu. T&#257;pat J&#363;s varat

nor&#257;d&#299;t citu nodal&#299;jumu un zemnodal&#299;jumu. Ja šie nodal&#299;jumi neeksist&#275;, tad tie

taps. L&#363;dzu nenor&#257;diet nodal&#299;jumu un zemnodal&#299;jumu nosaukum&#257; neapvienojamus

simbolus.",

436=>"Nedz&#275;s&#299;šu p&#275;d&#275;jo preci.",

437=>"Veiksm&#299;gi dz&#275;sts",

438=>"Nav iesp&#275;jams atjaunot.",

439=>"Vai J&#363;s tieš&#257;m gribar dz&#275;st šo preci?",

440=>"Aiztais&#299;t logu un p&#257;riet nodal&#299;jum&#257;",

441=>"J&#363;s non&#257;ksiet rad&#299;taj&#257; nodal&#299;jum&#257; (ja nor&#257;d&#299;j&#257;t jaunu nodal&#299;jumu), lai tas

nenotiktu - aiztaisiet logu ar pogu [X]",

442=>"Nodal&#299;juma dz&#275;šana",

443=>"J&#363;s patieš&#257;m gribat dz&#275;st visu prece šaj&#257; nodal&#299;jum&#257;?",

444=>"Mazo foto iel&#257;de/iestarpin&#257;jums no fotogalerijas",

445=>"Lielo foto iel&#257;de/iestarpin&#257;jums no fotogalerijas",

446=>"Dz&#275;st lielo foto lauku",

447=>"Izveidots jauns nodal&#299;jums",

448=>"Preces karte",

449=>"Vitr&#299;na",

'short'=>"&#298;ss apraksts",

'artlink'=>"Panta numurs vai mape (ex. a0001 or ./mp3/dir)",

'kwrds'=>"Atlaides (ex. 10%),atsl&#275;gv&#257;rdi (ex. plasmatv) un opcijas (ex.

option1)",



450=>"Ja J&#363;s zinat savu pas&#363;t&#299;juma numuru un E-mail, kas ir nor&#257;d&#299;ts pie

pas&#363;t&#299;juma - tas &#316;aus Jums noskaidrot uz k&#257;da etapa atrodas pas&#363;t&#299;jums.",

451=>"Re&#291;istr&#275;tie lietot&#257;ji var apskat&#299;t saturu un iepriekš&#275;jo pas&#363;t&#299;jumu

statusus.",

452=>"Ja J&#363;s izdar&#299;j&#257;t pas&#363;t&#299;jumu bez re&#291;istr&#257;cijas - J&#363;s varat izskat&#299;t tikai

J&#363;su pas&#363;t&#299;jumu izpild&#299;juma statusus, tad ievadiet pas&#363;t&#299;juma numuru un savu

E-mail (kuru j&#363;s nor&#257;d&#299;j&#257;t pie dot&#257; pas&#363;t&#299;juma noform&#275;juma) form&#257; ",

453=>"Nor&#257;diet tikai ciparus",

454=>"Pas&#363;t&#299;jumu nummurs",

455=>"P&#257;rbaud&#299;t",

456=>"Lietot&#257;ja inform&#257;cija atjaunota",

457=>"Nav pareizs pas&#363;t&#299;juma nummurs",

458=>"P&#257;rbaudes rezult&#257;ts",

459=>"E-mail, kas nor&#257;d&#299;ts pas&#363;t&#299;jum&#257; nesakr&#299;t ar J&#363;su ievad&#299;to. Pas&#363;t&#299;juma

statusa att&#275;lojums nav iesp&#275;jams p&#275;c droš&#299;bas apsv&#275;rumiem. Ievediet E-mail, kas

ir nor&#257;d&#299;ts pas&#363;t&#299;jum&#257;, lai apskat&#299;tos pas&#363;t&#299;juma statusu",

460=>"Lietot&#257;ja datu mai&#326;a",

461=>"Pas&#363;t&#299;jums nav atrasts.",

462=>"Uz ko J&#363;s gribat noform&#275;t pas&#363;t&#299;jumu?",

463=>"Identifik&#257;cija",

464=>"Re&#291;istr&#275;tiem lietot&#257;jiem.",

465=>"Ja J&#363;s atceraties savu login un paroli, tad ievadiet tos atbilstošajos

laukos:",

466=>"Turpin&#257;t pas&#363;t&#299;juma noform&#275;šanu",

467=>"Jaunajiem lietot&#257;jiem",

468=>"J&#363;s varat noform&#275;t pas&#363;t&#299;jumu bez re&#291;istr&#257;cijas. Bet J&#363;s nevar&#275;siet

izsekot savu pas&#363;t&#299;juma statusu. Gribat noform&#275;t pas&#363;t&#299;jumu bez re&#291;istr&#257;cijas?",

469=>"Noform&#275;t pas&#363;t&#299;jumu bez re&#291;istr&#257;cijas",

470=>"P&#257;rbaud&#299;t.",

471=>"Izv&#275;l&#275;ties pils&#275;tu...",

472=>"Izv&#275;lieties valsti...",

473=>"Cita valsts...",

474=>"Cita pils&#275;ta...",

475=>"Cits metro...",

476=>"Apmaks&#257;jiet ar:",

477=>"Visa",

478=>"MasterCard",

479=>"American Express",

480=>"Banka",

481=>"Droš&#257; transakcija",

482=>"Uzman&#299;bu!<br>

&#298;stenojiet maks&#257;jumu tikai p&#275;c veikala operatora apstiprin&#257;juma par preces

esam&#299;bu noliktav&#257; un pieg&#257;des iesp&#275;j&#257;m.<br>

Ja J&#363;s izdar&#299;siet maks&#257;jumu bez apstiprin&#257;juma un preces neb&#363;s noliktav&#257; -

l&#299;dzek&#316;u atgriešana tiks &#299;stenota iev&#275;rojot<br>

komisiju pa p&#257;rvedumu!",

483=>"P&#275;c J&#363;su pas&#363;t&#299;juma p&#257;rbaudes, ar Jums sazin&#257;sies",

484=>"J&#363;s varat apmaks&#257;t J&#363;su pas&#363;t&#299;jumu tieši tagad, vai 3.dienu laik&#257; caur

personisku kabinetu uz m&#363;su saita.",



485=>"ATCELT",

486=>"Atveda br&#257;&#311;i",

487=>"Pieg&#257;d&#257;ts",

488=>"Dab&#363;ts (ïî÷òà)",

489=>"Ie&#326;&#275;mums",

490=>"Nav noliktav&#257;",

491=>"Nav pasp&#275;jis",

492=>"Dzests",

493=>"Dzests",

494=>"Izdevumi",

495=>"Alga",

496=>"T&#257;lrunis",

497=>"Mob. telefons",

498=>"Internets",

499=>"Pr&#275;mija",

500=>"Caurbraukšana",

501=>"Iepirkšana",

502=>"P&#257;rdots",

503=>"Atteikums",

504=>"Pieteikums",

505=>"Pasts",

506=>"Apstr&#257;d&#257;j&#257;s",

507=>"Gaida apmaksu",

508=>"Viss ir uz vietas",

509=>"Aizs&#363;t&#299;ts (pasts)",

510=>"Atg&#257;d&#257;jams",

511=>"Apmai&#326;a",

512=>"Atlikts",

513=>"Atgriešana",

514=>"Atgriešana (pasts)",

515=>"Payment for goods",

516=>"",

517=>"",

518=>"",



519=>"Apmaksa ar cit&#257;m val&#363;t&#257;m",

520=>"Apmaks&#257;t",

521=>"Aizb&#257;šanu kr&#257;sas",



522=>"Šo lapaspusi var atjaunot",

523=>"Uzst&#257;d&#299;t autoatjaunošanu",

524=>"sek",

525=>"min",

526=>"Saglab&#257;t pas&#363;&#299;jumu DB",

527=>"Saglab&#257;t",

528=>"(pielietot tikai as&#257;s nepieciešam&#299;bas gad&#299;jumos!)",
529=>"Neatjaunojiet lapu p&#275;c datu p&#257;rraides!!!",
530=>"Pat&#275;ri&#326;š",
531=>"Summa",
532=>"V&#275;sture",
533=>"Kurj&#275;rs un datums",
534=>"Tekoš&#257; ned&#275;&#316;a",
535=>"sk. augst&#257;k",
536=>"Visi pas&#363;t&#299;jumi",
537=>"Janv&#257;ris",
538=>"Febru&#257;ris",
539=>"Marts",
540=>"Apr&#299;lis",
541=>"Maijs",
542=>"J&#363;nijs",
543=>"J&#363;lijs",
544=>"Augusts",
545=>"Septembris",
546=>"Oktobris",
547=>"Novembris",
548=>"Decembris",
549=>"Lai atjaunotu lapu izmantojiet linku",
550=>"Nelietojiet ar&#299; BACK pogu J&#363;su brouzer&#299;!",
551=>"M&#275;nesis",
552=>"GRAFIKS",
553=>"PIETEIK",
554=>"ATTEIK",
555=>"PIEG&#256;D",
556=>"PE&#315;&#325;A",
557=>"NAUDAS GRAFIKS",
558=>"Nav pieg&#257;d&#257;ts",
559=>"Pieg&#257;d&#257;ts",
560=>"Šom&#275;nes pieg&#257;d&#257;to pas&#363;t&#299;jumu",
561=>"pas&#363;t&#299;jumu",
562=>"Kurj&#275;rs",
563=>"Pieg&#257;de",
564=>"Pal&#299;dz&#299;ba",
565=>"ien&#257;kumu un izdevumu prognoz&#275;",
566=>"kurj&#275;ram samaks&#257;ja par pieg&#257;di",
567=>"kurj&#275;ram nav samaks&#257;juši par pieg&#257;di",
568=>"Pe&#316;&#326;a",
569=>"neskait&#257;s",
570=>"izcelts ar violetu kr&#257;su",
571=>"uz summu",
572=>"Pas&#363;t&#299;jumu maksimums",
573=>"bez atteikumu uzskaites",
574=>"Mekl&#275;jums klientu b&#257;z&#275;",
575=>"Pieg&#257;d&#257;ts",
576=>"M&#275;s",
577=>"Klienti",
578=>"Vairumtirdz.",
579=>"Vairtirgot&#257;jam",
580=>"Info",
581=>"Filtrs",
582=>"P&#257;rdošanu statistika pa m&#275;nešiem",
583=>"Tikai atg&#257;d&#257;to pas&#363;t&#299;jumu uzskaite",
584=>"Prognoze",
585=>"Pe&#316;&#326;as prognoze",
586=>"Prognoze kurj&#275;riem",
587=>"Kop&#275;j&#257; pe&#316;&#326;a",
588=>"Nav atrasts neviens pas&#363;t&#299;jums",
589=>"J&#363;su pas&#363;t&#299;juma jauns statuss",
590=>"Statusa izmai&#326;as datums",
591=>"Atdots kureram",
592=>"Nav j&#257;s&#363;ta datus atk&#257;rtoti!",
593=>"jau bija piesavin&#257;ts",
594=>"P&#275;c 5 sekund&#275;m p&#257;reju pas&#363;t&#299;jumu sarakst&#257;. Gaidiet",
595=>"Pieg&#257;des maksa",
596=>"no",
597=>"uz",
598=>"Pas&#363;t&#299;juma p&#257;rnesums",
599=>"kods",
600=>"Tais&#257;m ciet ned&#275;&#316;u un zem&#257;k",
601=>"Faila kop&#275;šanas k&#316;&#363;da",
602=>"Veiksm&#299;gi uztais&#299;ta rezerves kopija",
604=>"Ned&#275;&#316;a ir aizv&#275;rta. Pagaidiet, p&#275;c 3 sekund&#275;m notiks p&#257;reja atpaka&#316;.",
605=>"maina izdevumus",
606=>"maina iepirkumu",
607=>"izmain&#299;ja pasta atiešanas numuru",
608=>"J&#363;s varat p&#257;rbaud&#299;t savu pastu s&#363;t&#299;jumu link&#257;",
609=>"J&#363;su s&#363;t&#299;juma numurs",
610=>"ir iecelts s&#363;t&#299;juma Numurs",
611=>"Pie pas&#363;t&#299;juma p&#257;rnesuma m&#275;&#291;in&#257;juma - Datuma Ievades K&#316;&#363;da",
612=>"Izmain&#299;t s&#363;t&#299;juma numuru",
613=>"NED&#274;&#315;A AIZV&#274;RTA",
614=>"AIZV&#274;RT NED&#274;&#315;U",
615=>"J&#363;s nevar&#275;siet vair&#257;k izmain&#299;t datus.",
616=>"Izdevumu v&#275;sture",
617=>"Pievienot izdevumus",
618=>"Problem&#257;tiskie cilv&#275;ki",
619=>"Ned&#275;&#316;a",
620=>"Kv&#299;ts",
621=>"nav uz vietas",
622=>"vien&#299;gaj&#257; eksempl&#257;r&#257;",
623=>"&#316;oti maz",
624=>"ierobežot&#257; daudzum&#257;",
625=>"ir uz vietas",
626=>"daudz",
627=>"Partneru programma",
628=>"Uzman&#299;gi izlasiet zem&#257;k sekojošu partneru nol&#299;gumu",
629=>"Ja J&#363;s piekr&#299;tat šiem nosac&#299;jumiem, tad varat piere&#291;istr&#275;ties k&#257; partners",
630=>"Izv&#275;laties sev jebkuru partnera identifikatoru, piem&#275;ram saita nosaukums, kur tiks uzst&#257;d&#299;ti partneru kodi. Tiek at&#316;auts izmantot tikai ciparus, lat&#299;&#326;u alfab&#275;ta burtus, _ z&#299;mi, defisi un punktu. Piem&#275;rs:",
631=>"Ja to at&#316;&#257;va saita administrators - visi partneru pas&#363;t&#299;jumi b&#363;s autom&#257;tiski izs&#363;t&#257;mi uz doto E-mail",
632=>"Uzrakstiet &#299;si J&#363;su saita tematiku, k&#257; ar&#299; nor&#257;diet šeit vai ir vajadz&#299;ga jebk&#257;da HTML vai PHP-koda izpilde aizs&#363;tot partneru pas&#363;t&#299;jumu. Ne rakstiet l&#363;dzu pašu HTML kodu šeit.",
633=>"T&#257;ds Partner ID jau eksist&#275; - izv&#275;laties sev citu!",
634=>"Tagad J&#363;s varat piedal&#299;ties m&#363;su partneru programm&#257;.",
635=>"J&#363;s varat uzst&#257;d&#299;t m&#363;su rekl&#257;mas baneri un linku uz J&#363;su saitu ar sekojošo URL:",
636=>"Šaj&#257; gad&#299;jum&#257; visi klientu pas&#363;t&#299;jumi non&#257;kuši no J&#363;su saita pa šo linku tiks &#326;emti v&#275;r&#257; j&#363;su lab&#257;. T&#257;pat šie pas&#363;t&#299;jumi b&#363;s autom&#257;tiski izs&#363;t&#257;mi uz J&#363;su elektronisko pastu, ja to at&#316;&#257;va saita administrators",
637=>"Ja ir piepras&#257;ma HTML vai PHP-koda, kurš autom&#257;tiski iere&#291;istr&#275;s doto pas&#363;t&#299;jumu cit&#257;s partneru sist&#275;m&#257;s uz m&#363;su saitu uzst&#257;d&#299;šana - ar Jums sasaist&#299;sies m&#363;su saita administrators. Šaj&#257; gad&#299;jum&#257; - J&#363;s izs&#363;tiet šo kodu t&#257; p&#257;rbaudei uz droš&#299;bu. P&#275;c tam - tas tiks uzst&#257;d&#299;ts.",
638=>"Lai no jauna iepaz&#299;ties ar m&#363;su partneru nol&#299;gumu uzspiediet sekojošo linku:",
639=>"Partneru nol&#299;gums",
640=>"T&#257;pat J&#363;s varat uzst&#257;d&#299;t Java-vitr&#299;nu sev uz saita ar preci no m&#363;su asortimenta.",
641=>"Jums ir j&#257;ieliek sev uz lapu sekojošais HTML-kods:",
642=>"J&#363;s varat izvad&#299;t ne tikai visu preci no m&#363;su asortimenta, bet ar&#299; tikai atseviš&#311;us nodal&#299;jumus, lai uzzin&#257;tu, k&#257; to izdar&#299;t - v&#275;rsieties pie m&#363;su saita administratora.",
643=>"Par jebkuriem jaut&#257;jumiem partneru programm&#257; griežaties uz E-mail:",
644=>"Š&#299; inform&#257;cija un kontakts ar administratoru aizs&#363;t&#299;ts uz J&#363;su nor&#257;d&#299;to E-mail",
645=>"Email sakaram:",
646=>"J&#363;su k&#316;&#363;das:",
647=>"J&#363;s izmain&#299;j&#257;t pamatparametrus:",
648=>"Noz&#299;me",
649=>"Neaizv&#275;rt&#257;s p&#275;di&#326;as. Redi&#291;&#275;jiet noz&#299;mi!",
650=>"Rinda.",
651=>"Skaitlis",
652=>"Izveidots jauns links",
653=>"Atsl&#275;gv&#257;rds",
654=>"Jauna linka pievienošana izv&#275;lnei",
655=>"Notiek aizvietošana",
656=>"Iecelšana",
657=>"Izmain&#299;ts",
658=>"Notika izmai&#326;as! Jums pieprasa p&#257;rindeks&#275;t b&#257;zi.",
659=>"Glob&#257;l&#257;s izmai&#326;as datu b&#257;z&#275;",
660=>"Uz J&#363;su person&#299;g&#257;m bail&#275;m un risku!",
661=>"Pirms t&#257; rekomend&#275;jams izdar&#299;t",
662=>"Samain&#299;t",
663=>"Nomain&#299;t",
664=>"Nodal&#299;jum&#257;",
665=>"Mazie foto",
666=>"Papild. foto",
667=>"Brends",
668=>"Links uz pantu",
669=>"Piln&#299;gs apraksts",
670=>"Daudzums noliktav&#257;",
671=>"Visur",
672=>"nodal&#299;jumu / zemnodal&#299;jumu p&#257;rsaukšana",
673=>"P&#257;rsaukt",
674=>"Redi&#291;&#275;jiet un nospiediet OK",
675=>"Preèu katalogu saraksts",
676=>"Atlaidi nor&#257;diet bez % z&#299;mes",
677=>"Izv&#275;l&#275;t&#257;s kr&#257;sas kods",
678=>"Aizb&#257;znes veids",
679=>"kr&#257;sas HEX kods",
680=>"Dublik&#257;ti prec&#275;s nav atrasti",
681=>"Vid&#275;jais pirc&#275;ju reitings",
682=>"Paskat&#299;ties atsauksmes",
683=>"J&#363;su balss",
684=>"L&#363;dzu nov&#275;rt&#275;jiet šo preci 5 ba&#316;&#316;u sist&#275;m&#257;",
685=>"p&#275;c reitinga",
686=>"Ar cipariem nor&#257;diet nodal&#299;jumu un zemnodal&#299;jumu sec&#299;bu",
687=>"K&#257;rt&#299;ba",
688=>"J&#257;b&#363;t nor&#257;d&#299;tam URL baneriem uz partnera saita p&#257;reju uzskaitei",
689=>"Nav nor&#257;d&#299;ts E-mail(izmantojiet 0-9 a-z A-Z @.-_) partnera nosaukums (izmantojiet 0-9 a-z A-Z un _)",
690=>"Jaun&#257; partnera pievienošana",
691=>"Piem&#275;rs",
692=>"Izmantojiet tikai lat&#299;&#326;u burtus, ciparus, punktu, defisi un _ simbolu",
693=>"Šis kods tiks izvests p&#275;c pas&#363;t&#299;juma noform&#275;juma, tas var b&#363;t JAVA skripts, kas iere&#291;istr&#275; pas&#363;t&#299;jumu cit&#257; partneru sist&#275;m&#257;. Ja J&#363;s vienk&#257;rši gribat aizs&#363;t&#299;t pas&#363;t&#299;jumu partnerim pa zem&#257;k nor&#257;d&#299;tu E-mail - atst&#257;jiet šo lauku tukšu.",
694=>"Šablonu izmantošana",
695=>"J&#363;su saita URL",
696=>"pas&#363;t&#299;juma numurs",
697=>"Cena bez pieg&#257;des",
698=>"pas&#363;t&#299;t&#257;ja val&#363;ta",
699=>"pas&#363;t&#299;t&#257;ja E-mail",
700=>"Pas&#363;t&#299;t&#257;ja v&#257;rds uzv&#257;rds",
701=>"Pas&#363;t&#299;t&#257;ja tel. numurs",
702=>"Uz šo E-mail partnerim atn&#257;ks vi&#326;a partneru pas&#363;t&#299;jumu kopijas, ja tas nav piepras&#257;ms - atst&#257;jiet lauku tukšu",
703=>"Izveidot partneri",
704=>"Izmai&#326;as saglab&#257;tas",
705=>"Fona kr&#257;sa",
706=>"Preces un groza fons",
707=>"Gr&#257;matz&#299;me grozs",
708=>"Tumš&#257; pamatkr&#257;sa",
709=>"Gaiš&#257; pamatkr&#257;sa",
710=>"Teksta kr&#257;sa",
711=>"&#274;nas kr&#257;sa",
712=>"Cepures kr&#257;sa 1",
713=>"Cepures kr&#257;sa 2",
714=>"Šrifta kr&#257;sa cepur&#275;",
715=>"L&#299;nijas kr&#257;sa cepur&#275;",
716=>"Izmantot&#257;s kr&#257;sas",
717=>"Tekoš&#257;",
718=>"T&#275;mas nosaukums",
719=>"Izmantot kr&#257;sas",
720=>"Dz&#275;sts t&#275;mu",
721=>"Sglab&#257;t t&#275;mu",
722=>"Izv&#275;l&#275;t&#257; kr&#257;sa",
723=>"Saglab&#257;t&#257;s kr&#257;sas",
724=>"Nospiediet uz t&#275;mu lietošanai",
725=>"Saglab&#257;t k&#257; jauno t&#275;mu",
726=>"Izceliet š&#363;nu bet p&#275;c tam uzspiediet uz kr&#257;su, kura ir vajadz&#299;ga jums.",
727=>"Direktorija ir veiksm&#299;gi aizsarg&#257;ta ar paroli",
728=>".htaccess saturs",
729=>".htpasswd saturs",
730=>"Nor&#257;diet login un paroli",
731=>"See also",
732=>"Acessories",
733=>"Other items of this catalogue",
734=>"Bookmarks",
735=>"Special Offer of the day",
736=>"Price visible after registration and admin verify",
737=>"Users has special price",
738=>"Photogallery",
739=>"Directory",
740=>"Supported file types",
741=>"Choose file",
742=>"Upload",
743=>"Success upload to directory",
744=>"Delete",
745=>"Do you really want to delete the folder and all its contents?",
746 => "Are you sure you want to delete the file?",
747 => "Failed to remove",
748 => "Error creating folder",
749 => "New Folder",
750 => "Folder with that name already exists. Specify another folder name.",
751 => "File with that name already exists. Specify a different file name.",
752 => "Quick Order",
753 => "Just enter your name, phone number and desired time of delivery - our operator will call you and ask you wished time of delivery of selected items:",
754 => "Phone number (with area code)",
755 => "Delivery date",
756 => "Only in OUR city!",
757 => "Specify custom delivery date and time",
758 => "You can close this window.",
759 => "ERROR! YOU ARE NOT FILL REQUIRED FIELD! ",
760 => "Product ID not specified, or PRODUCT NOT FOUND!",
761 => "ERROR! You DO NOT choose any product!",
762 => "ERROR: This Product not found!",
763 => "You have already sent this request to call back",
764 => "Please do not repeat your request again! Our operator will call you.",
765 => "Tomorrow",
766 => "12:00-16:00",
767 => "16:00-19:00",
779 => "12:00-19:00",
768 => "Quick Order<br>of this product",
769 => "For example: +7 (499) XXX-XXXX, +7-903-XXX-XXXX",
770 => "Nearest delivery date:",
771 => "Mon",
772 => "Tue",
773 => "Wed",
774 => "Thu",
775 => "Fri",
776 => "Sat",
777 => "Sun",
780=>"Tax",
781=>"Excl.Tax",
782=>"Incl.Tax",
783=>"Click on the desired picture to insert",
784=>"Insert",
785=>"Please do not remove any images from the gallery in case of using on the site!",
786=>"Images per page",
787=>"Increase the input field",
788=>"Reduce the input field",
789 => "Avatara Base (./Base.zip) was not found.",
790 => "Create a new blank database ...",
791 => "Folder with the database exists.",
792 => "Your actions:",
793 => "Extract base base.zip",
794 => "Extract files with replace",
795 => "Compress an existing database to archive base.zip",
796 => "Question",
797 => "Set",
798 => "Redirect to site",
799 => "List of unanswered questions (past 100)",
800 => "This issue has already been asked, but Eve is not able to accurately answer it. Try to ask another question or ask a question later, when the operator will teach Eve, how to answer that question.",
801 => "Eve can not exactly answer your question. Try to ask another question or ask a question later, when the operator will teach Eve, how to answer that question.",
802 => "Eva (thought a little)",
803 => "You did not answer",
804 => "Answer yet. Try to answer by yourself.",
805 => "Reply",
806 => "Post Reply",
807 => "The exact answer exists! If you want to correct - you can change it.",
808 => "Tag",
809 => "Number of requests",
810 => "Link",
811 => "Not displayed",
812 => "Do not display the tag",
813 => "If you want to tag in the future did not appear in a cloud of tags - put in his number of queries value of NA and then click here",
814 => "The most popular tag",
815 => "Add new tag",
816 => "Create",
817 => "Darba laiks",
818 => "Sl&#275;gts",
819 => "Ned&#275;&#316;as nogal&#275;s un sv&#275;tku dien&#257;s pieg&#257;de tiek veikta tikai vienojoties ar vad&#299;t&#257;ju.",
820 => "Orders izpild&#299;ts vair&#257;k nek&#257; ned&#275;&#316;as nogal&#275; un br&#299;vdien&#257;s tiek apstr&#257;d&#257;ti n&#257;kamaj&#257; darba dien&#257;.",
821 => "birojs ir atv&#275;rts",
822 => "birojs nedarbojas",
823 => "birojs jau ir sl&#275;gta",
824 => "biroja atveras",

825 => "You have provided an incorrect answer to the question. Please try again.",
826 => "Answer the question to proceed",
827 => "The installation number",
828 => "License number",
829 => "The license number is accepted. Thank you for purchasing our product.",
830 => "Without a license number, you can use all the features of the engine, except the shop-module.",
831 => "To activate the module, please call us",
832 => "Software Version",
833 => "You are using the latest version",
834 => "New version available",
835 => "ChangeLog",
836 => "You can free upgrade to a newer version by yourself (in this case you have no warranty) or use a paid service to update your engine to the new version. To get a new version - please call us " ,
837 => "Remember that using of our software ILLEGALLY - acquired by cracking can lead to the loss of your data, the inclusion of viruses by hackers and other malicious code, which you'll be not able to control, infection of your customers and prosecution. We are responsible for stolen software software. Buying legally - you contribute to its further development and you have the right to an independent free upgrade to the latest version corrects errors that have arisen due to our fault during the entire period of use, free installation on your hosting is suitable for the parameters of the reasonable support , advice by e-mail or phone during working hours and days, and other possible assistance by phone ",
838 => "License server answer",
839 => "Please do not send the installation code and a list of licensed code into the wrong hands!",
840 => "This domain is found in database licenses, you can see which licenses have been generated for this domain and can use one of them (usually the latest). If the license is not suitable, please use request a license in admin menu.",
841 => "This domain is not found in database licenses. You have 30 day evaluation license. You can buy FULL license to use the site, store, WITHOUT LIMITATION, as our favorite customer.",
842 => "No license found",
843 => "Expires",
844 => "Unlimited",
845 => "Evaluation Expired",
846 => "Evaluation version",
847 => "No connection to the registration server",
848 => "Not available",
849 => "Due to lack of communication with the server registration, license reset. Please connect to the Internet and get a license again.",
850 => "You have left",
851 => "days of legal use",
852=>"Reload license. Done.",
853=>"Photo watermark",
854=>"Random photo renamer",
855=>"Watermark",
856=>"Font color",
857=>"Stroke text",
858=>"Photos without watermark only",
859=>"Process ALL photos",
860=>"<br><br><div class=round><h4><a href=index.php?action=zakaz>Go to Order checkout?</a></h4></div>",
861=>"Icon",
862=>"Title",
863=>"Tags or synonyms. Please specify a comma-separated, ex.<i> tag1,tag2,tag3</i>",
864=>"Tags",
865=>"Create small thumbnails from big photos",
866=>"Thumbnail max size",
867=>"pixels",
868=>"Brands admin",
869=>"Recalculate prices",
870=>"RSS indexing",
871=>"Invoice template",
872=>"Partners",
873=>"DB Export",
874=>"DB Import",
875=>"Create new item",
876=>"Warning! Do not create items with the same name and item code!",
877=>"Create new item in this category",
878=>"Create category description",
879=>"Categories and subcategories will be created automatically after indexing sections.",
880=>"Brands list will be created automatically after indexing sections. Please fill Brand in item cart.",
881=>"To see brand in brands list on the main page, please check box the brand, fill all brand info, then press Change button.",
882=>"Site",
883=>"Link Url",
884=>"To edit used languages, values and other parameters click on button below",
885=>"To set up payment methods and delivery systems, the names of couriers and current language pack, click on button below",
886=>"Option",
887=>"Showcase viewing option",
888=>"Please go back to see result after changing this option.",
889=>"Disable module",
890=>"Enable module",
891=>"RSS chanels",
892=>"RSS chanels and parser template you can edit here",
893=>"css.inc -> \$rssurl",
894=>"module disabled",
895=>"Showcase",
896=>"Random items with sale",
897=>"Align",
898=>"Left",
899=>"Center",
900=>"Right",
901=>"Add news",
902=>"Default language",
903=>"Default currency",
904=>"Default price round",
905=>"Installed",
906=>"Not installed",
907=>"List of available language packs",
908=>"Blog",
909=>"My diary",
910=>"Last comment",
911=>"Comment deleted",
912=>"Send comment",
913=>"Imploded view",
914=>"Exploded view",
915=>"New topic",
916=>"Create new topic",
917=>"[cut]",
918=>"Place this tag before cutted text",
919=>"Read more",
920=>"No comments",
921=>"Empty",
922=>"Empty.",
923=>"Previous",
924=>"Next",
925=>"Insert image from other site (URL)",
926=>"Image URL (SRC)",
927=>"Insert Code",
928=>"URL",
929=>"HTML tags",
930=>"Bold",
931=>"Italic",
932=>"Underline",
933=>"Superscript",
934=>"Subscript",
935=>"Align right",
936=>"Align left",
936=>"Center text",
937=>"Insert link",
938=>"Upload / Insert image from photogallery",
939=>"Please authorize using accounts",
940=>"Login",
941=>"Classifieds",
942=>"Add to classifieds",
943=>"You do not have permissions to add classifields to this directory!",
944=>"You have not specify required form fields!",
945=>"No session data. Something wrong. Contact administrator!",
946=>"You will automatically redirect to you post. If not please click on",
947=>"this link",
948=>"Post not found. Maybe it was deleted or out of date.",
949=>"Posting Title",
950=>"Posting Description",
951=>"Price",
952=>"Directory not found!",
953=>"Read only classifieds!",
954=>"Empty",
955=>"Post to classifieds",
956=>"Post to THIS classifieds",
957=>"Please choose category",
958=>"Picture available",
959=>"Organize directories",
960=>"Enable write to this directory",
961=>"Disable write to this directory",
962=>"Write disable",
963=>"Write enable",
964=>"Transport company",
965=>"Contact person",
966=>"Company name",
967=>"Get by myself",
968=>"Turn ON administration functions",
969=>"Turn OFF administration functions",
970=>"Total votes",
971=>"Votes",
972=>"Thank you for voting!",
973=>"You vote for",
974=>"Vote for this",
975=>"Vote",
976=>"You are already voting",
977=>"Voting closed",
978=>"Voting is only for registered users!",
979=>"Error! oting not exists!",
980=>"Hack attempt!",
981=>"Not exists voting!",
982=>"Changes will be applied after indexation",
983=>"Changes are applied immediately",
984=>"<h4>Activation of your user account. Please wait 3 sec...</h4><br>If this does not happen automatically within 3 seconds, click on the link below:<br>",
985=>"Downloads",
986=>"Download file",
987=>"Upload files",
988=>"OR",
989=>"AND",
990=>"Close poll",
991=>"Open poll",
992=>"Undo URL",
993=>"If you kill any template or see any errors - DON`T PANIC! All changes may be reverted! In case of EMERGENCY or site failure (not working or blank screen) please use link above to undo changes. Please Bookmark this link!",
994=>"Restore", 995=>"User Agreement", 996=>"Privacy Policy",
997=>"Please share this if you like it.",
998=>"Share:",

999=>"Forum List",
1000=>"Last activity",
1001=>"Topics / Answers",
1002=>"Back to Forum List",
1003=>"Forum List Editor",
1004=>"Directories will be created automatically after entering forum",
1005=>"",
1006=>"Min: [num] [pcs]",
1007=>"Engine Mode",
1008=>"Enter search keywords minimum 3 chars",
1009=>"Minimal order:",
1010=>"Users online last [min_update] minutes",
1011=>"Chat",
1012=>"Private chat",
1013=>"enter chat",
1014=>"leave chat",
1015=>"send you a message via chat",
1016=>"waiting you",
1017=>"Enter chat",
1018=>"Please choose a chat room",
1019=>"Registered users only",
1020=>"For any useres including guests",

1021 => "Jobs",
1022 => "Post Vacancy",
1023 => "Position",
1024 => "Salary",
1025 => "Jobs created successfully",
1026 => "Require",
1027 => "Not required",
1028 => "Sorry! There are currently no vacancies.",
1029 => "Vacancy has been deleted",
1030 => "Requirements",
1031 => "Date Published",
1032 => "Phone",
1033 => "Send CV",
1034 => "Employee",
1035 => "Date set for this job",
1036 => "no",
1037 => "Curriculum Vitae",
1038 => "Vacancy",
1039 => "Quote",
1040=>"Article",

1041=>"Warning!",
1042=>"This site contains adult material",
1043=>"If you already have 18, you can login to the site. Administration is not responsible for any consequences for you, if you incorrectly reported your age.",
1044=>"I already 18 / Enter site",
1045=>"Leave the site",
1046=>"If you are under 18 years of age you must leave the site immediately!",
1047=>"pegi18.png",
1048=>"Under 18 are prohibited",
1049=>"pegisex.png",
1050=>"Scenes of explicit sexual nature",
1051=>"pegi_violance.png",
1052=>"Violence",
1053=>"pegibad.png",
1054=>"Slang, swearing",
1055=>"http://www.pegi.info",
1056=>"http://www.google.com",
1057=>"pegibg.png",
1058=>"",
1059=>"#ffffff",
1060=>"#000000",
1061=>"#b94a48",
1062=>"#ffff00",

1063=>"Novice",
1064=>10,
1065=>"User",
1066=>250,
1067=>"Rising star",
1068=>500,
1069>"Advanced User",
1070=>750,
1071=>"Flooder",
1071=>999,
1073=>"Superuser",
1074=>"Moderator",

1075=>"Send message to user",
1076=>"Back to top",
1077=>"Forum Search",
1078=>"Search by keyword",
1079=>"Search by User",
1080=>"Only for registered users",
1081=>"Please register",
1082=>"You have attempts",
1083=>"No more attempts please. You need to restore you password.",
1084=>10,
1085=>"Yo can find messages from user",
1086=>"Please enter user nickname",
1087=>"Forum index",
1088=>"Load RSS feeds",
1089=>"Search all messages from this user",
1090 => "Offers catalogue",
1091 => "Load URL fails - check the URL and access to a web server.",
1092 => "Location can not be parsed due to lack of module curl (or file_get_contents). Check PHP configuration.",
1093 => "Download failed, or parser get blank page.",
1094 => "Upload successful! Your offers are placed in the catalogue durectory",
1095 => "You are not allowed to upload offers!",
1096 => "The specified directory is not allowed to place offers!",
1097 => "Not specified directory or directory does not exist!",
1098 => "You have not specified URL to parse!",
1099 => "Offers Information",
1100 => "Name",
1101 => "Show #",
1102 => "Page not found / 404 Not found",
1103 => "Not found. Possible link has changed ...",
1104 => "After 5 seconds, you will automatically go to the main page. If not, click on direct link:",
1105 => "Catalog",
1106 => "All",
1107 => "Data Type",
1108 => "Add offers to",
1109 => "Enter the URL of your offers feed",
1110 => "(also taken RSS, YML, GoogleXML and other 4-level XML)",
1111 => "Downloaded data may be filtered by keyword, please specify them with a comma",
1112 => "Offers not containing these keywords will be ignored",
1113 => "Upload",
1114 => "Please specify only numbers, such as 129.99",
1116 => "Proceed to Payment",
1117 => "Enter the amount of deposit",
1118 => "Go back to your account",
1119 => "Select the payment method",
1120 => "Account",
1121 => "Total",
1122 => "Charge Account",
1123 => "Your personal account will be charged by our operators after the arrival within working hours.",
1124 => "Change Avatar",
1125 => "Avatars Gallery",
1126 => "Confirm your selection by clicking on the desired image",
1127 => "Select Logo",
1128 => "If you want more pictures and logos - contact the site administrators or send your logo or photo to our contact E-Mail",


1130 => "Tags import from file",
1131 => "Data Format",
1132 => "Previous offer supplier",
1133 => "Previous offer supplier",
1134 => "Total supliers in this directory",
1135 => "Supplier",
1136 => "Visit suppliers site",
1137 => "You go to another offers suplier!",
1138 => "This will happen automatically after 1 sec. If not - click NEXT or PREV buttons by yourself.",
1139 => "Not found offers by your request",
1140 => "Use only letters a-z, 0-9 and _",
1141 => "The Full name",
1142 => "Manage catalogue directories",
1143 => "Index catalogue for search",
1144 => "Get Values rates",
1145 => "Manage chats",
1146 => "Operators chat",
1147 => "Current account recharged by",

1148 => "This payment already done, do not update the page twice!",
1149 => "Transaction failed",

1150 => "Leave your phone number and we'll call you back",
1151 => "Please wait. Operator will call you as soon as possible.",
1152 => $sms_mail, // &#8203;&#8203;E-mail the operator on the phone
1153 => "Call me!",
1154 => "Your phone",
1155 => "Your name",
1156 => "Callback available only for the local telephone network.",
1157 => "Please fill in the required fields:",
1158 => "You did not fill all required fields!",
1159 => "You have already ordered callback today.",
1160 => "Callback Request successfully sent to the operator.",
1161=>"Charge off",
1162=>"Specify charge off sum",
1163=>"Current account charged off by",
1164=>"This charge off already done, do not update the page twice!",
1165=>"Vendors of the current section",
1166=>"Site URL",
1467=>"Choose your position...",
1468=>"Choose your job...",
1469=>"Other position...",
1470=>"Other job...",
1471=>"Your position",
1472=>"Job",
1473=>"Job List",
1474=>"To view statistics of working time, click on the user name",
1475=>"Select users you want to send a message",
1476=>"Select the user group you want to send a message",
1477=>"Send by E-mail",
1478=>"Attention! E-mail Posts may not be delivered if so much users. Do not use it unnecessarily!",
1479=>"Send to ALL",
1480=>"Send messages",
1481=>"Subject",
1482=>"Message center",
1483=>"No messages",
1484=>"New messages",
1485=>"Message archve",
1486=>"Call Skype",
1487=>"Send message",
1488=>"Offline",

1489=>"Stick Topic",
1490=>"UnStick Topic",
1491=>"Sticky Topic!",


1492=>"Today's birthday",
1493=>"Days remaining",
1494=>"Birthday soon",
1495=>"Happy Birthday!",
1496=>"Please accept my sincere congratulations! We wish you happiness, joy and success!",
1497=>"Birthdays",
1498=>"Email or Phone",
1499=>"Ad",
1500=>"You have already added an ad with a similar title!",
1501=>"Ban time",
1502=>"hour",
1503=>"6 hours",
1504=>"12 hours",
1505=>"day",
1506=>"3 days",
1507=>"week",
1508=>"2 weeks",
1509=>"month",
1510=>"3 months",
1511=>"6 months",
1512=>"year",
1513=>"forever",

1514=>"Ban reason",
1515=>"Violations",
1516=>"Inconsistency topic",
1517=>"Spam and advertising",
1518=>"Pointless messages",
1519=>"CapsLock abuse",
1520=>"Grammatical errors",
1521=>"Flood and too frequent posting",
1522=>"Rudeness and abuse",
1523=>"Policy discussion",
1524=>"Exceeding the maximum number of messages",

1525=>"IP banned",

1526=>"Ban ending time",
1527=>"IP already banned",
1528=>"Remove ban",
1529=>"Ban successfully removed",
1530=>"Sorry, your IP banned!",

1531=>"Your ad has been successfully added",
1532=>"Addition item rows",
1533 => "Please log in to post comments",

1534 => "Sorry, Today you can no longer post ads.",
1535 => "The maximum number of ads per day,",
1536 => 2, // &#8203;&#8203;max per day
1537 => "Terms of boards",

1538 => "One more time",
1539 => "Username is already in use",
1540 => "This E-mail is already used",
1540 => "Enter another E-mail",
1541 => "Username too short",
1542 => "Weak password",
1543 => "Average password",
1544 => "Strong Password",
1545 => "Contains illegal characters",

1546 => "More",
1547 => "Options",
1548 => "...",

1549 => "Main",
1550 => "Add. fields",
1551 => "Descriptions",
1552 => "Photo",
1553 => "Attachments",
1554 => "Add attachment",
1555 => "Available only after payment",
1556 => "To create an attachment - please create fields g:attach|ATT| and g:aoption|AO|",
1557 => "Files per page",
1558 => "Please do not delete files If it used on your site",

1559 => "Upcoming Events",
1560 => "This window is displayed when you try to exit from the site",
1561 => "Create Message",
1562 => "File not found",
1563 => "Unsupported File Type",
1564 => "one file per line",
1565 => "Attachments available for registered users only",
1566=>"All rights reserved",
1567=>"Contact us",
1568=>"Please wait a second...", 
1569=>"Item type",
1570=>"E-item 1 pcs",
1571=>"E-item unlim",
1572=>"Real product",
1573=>"Payment is not possible. Contact your administrator. Unknown rate",
1574=>"Language template - currencies array - USD",
1575 => "File is expired",
1576 => "Expiration Date and Time",
1577 => "You should download this file personally before the specified expiration date and time",
1578 => "Please do not post this link on other sites",
1579 => "Invalid token",
1580 => "Sold",
1581 => "Pay and instantly receive",
1582 => "You can instantly recieve this electronic item, please choose the file and click the button",
1583 => "This product can be delivered to you instantly after your payment.",
1584 => "Available",

1585 => "Notify user by E-mail",
1586 => "Payment History",
1587 => "Error debiting",
1588 => "You can not debit the sum more than exist in account!",
1589 => "Charge",
1590 => "Debit",
1591 => "The last 50 orders",
1592 => "The last visited URL",
1593 => "Search in the user database",
1594 => "Enter the login (user name), user name, full name, phone, address, etc.",
1595 => "Find",
1596 => "The amount of the transaction is less than zero!",
1597 => "Clear history of payments",
1598 => "Close",
1599 => "Your personal account will be debited by required sum.",
1600 => "Yes, I agree",
1601 => "No, thanks",
1602 => "File downloading will be started immediately in case you will have a required sum in you account.",
1603 => "Insufficient to pay. Please increase your account.",
1604 => "Enabled",
1605 => "The recommended amount of replenishment",
1606 => "Pay & Instant E-Delivery",

1607 => "E-mails List for mailing",
1608 => "Phones List for SMS sending",
1609 => "Export users to TXT w/delimiters",
1610 => "Display cards of all users",
1611 => "Warning: To remove the keywords filtering - Set an empty search query.",
1612 => "Site map",
1613=>"Editor",
1614=>"Reset changes",
1615=>"Searching... ",
1616=>"Please wait",
);

$netweight=17; //weight (column number in a database)
$def_weight=0.2; //default weight if not entered in item cart
$kg=" kg"; //kg
$vol=" m3"; //m3

//Only if you use themes:

$translate_it=Array (
);

$mpz=array (

'explore'=>"Explore",
'root_directory'=>"Root directory",
'back_to_higher_level'=>"back on higher level",
'sort_by'=>"Sort by:",
'by_name'=>"name",
'by_size'=>"size",
'by_date'=>"date",
'down'=>"DESC",
'up'=>"UP",
'download_from_ftp'=>"Download from FTP",
'download_from_http'=>"Download from HTTP",
'open_dir'=>"Open directory",
'from_ftp'=>"from FTP",
'play'=>"Play",
'stop'=>"Stop",
'time'=>"Time",
'bitrate'=>"Bitrate",
'album'=>"Album",
'genre'=>"Genre",
'artist'=>"Artist",
'track'=>"Track",
'min'=>"min",
'sec'=>"sec",
'your_ip'=>"Tour IP",
'granted'=>"Access granted",
'denied'=>"Access denied",
'edit_file_description'=>"Edit file description",
'del_file'=>"Delete file",
'undel_file'=>"Undelete file",
'file_or_dir'=>"File or directory",
'create_new_description'=>"Create new description",
'new_description'=>"New Description",
'success'=>"Success!",
'success_del'=>"Delete success!",
'success_undel'=>"Undelete success",
'description_file'=>"Description file",
'file_is_invisible'=>"Invisible file",
'file'=>"File",
'on'=>"ON",
'off'=>"OFF",
'no_description'=>"No description",
'description'=>"Description",
'exists'=>"exists",
'not_exists'=>"not exist",
'already'=>"already",
'hack'=>"Hack attempt?<br><br>Access Denied!",
'to_admin'=>"Please contact administrator.",
'html_tags'=>"HTML tags",
'clear'=>"Clear",
'undo'=>"Cancel",
'edit'=>"Send",
'error1'=>"Error! File /valid_ip.txt not found.<br><br>Contact administrator.",
'error2'=>"Error! Too many signs in description",
'error3'=>"Please return and cut.",
'width'=>"W:",
'height'=>"H:",
'search'=>"Search",
'query'=>"File search",
'back'=>"Back",
'file_list'=>"List of founded files",
'keyword'=>"Keyword",
'indexator'=>"Please wait! Process index database.",
'last_index'=>"Last index:",
'total'=>"Total:",
'total_dirs'=>", dirs:",
'total_files'=>", files:",
'total_size'=>", total size:",
'index_ok'=>"Indexing success.",
'index'=>"Archive indexing",
'creation'=>"Creation",

);

$reg_as=Array (
"An individual|1||",
"Company|1||",
"Businessman|1||",

);




$payment_metode=Array (
"Cash|1|||||||",
"Clearing (extract accounts)|1|+5%||||||",
"Payment via Bank (receipt)|1|+5%|bank.php|||||",
"Cash on delivery (via mail)|0|-150||||||",
"PayPal|1||paypal.php|dpz_1241878608_per@bk.ru|EUR|paypal|Pay via PayPal|",
"Electronic payment|0||electron.php|||||",
"Webmoney WMR|1||webmoney.php|R771486625113|WMR|wmr||",
);


$delivery_metode=Array (

"City delivery to you home|1|+5|1|||0|", //äîñòàâêà êóðüåðîì
"Self get in our office|1||0|||0|",
"Russian Post|1|+500|0|http://www.russianpost.ru/portal/ru/home/postal/trackingpo|post|100|",
"DHL Worldwide|1|+500|0|http://www.dhl.com/publish/g0/en/eshipping/track.high.html#aPar0001|post|100|",
"Fedex|1|+500|0|http://www.fedex.com/Tracking?cntry_code=ru|post|100|",
"CanadaPOST|1|+500|0|https://obc.canadapost.ca/emo/basicPin.do?trackingId=[tracknum]&trackingCode=PIN&action=query&amp;speek=en|post|100|",
"Custom|1|+500|0|http://www.url.com/tracking.php?track=[tracknum]&order=[ordernum]&email=[useremail]|post|100|",

);

$property_mode=Array (
" |1|",
"LTD|1|",
"JSC|1|",
"PUB|1|",
"INC|1|",
"LLC|1|",
"IND|1|",

);

$kur=Array(
"-"=>"#ffffff",
"John"=>"#22ff22",
"Kate"=>"#aaaaaa",
"Lasey"=>"#A7D7F3",
"Tanya"=>"#FF9900",
"Britney"=>"#FFFF00",
"Other"=>"#9966FF");

$maximumprice=999999999;
$fromarray=Array(50,250,500,1000,2000,5000);

$toarray=Array(500,1000,3000,5000,10000,50000);

//Make your own script language ".$lang[]."

//paypal
$pp_form_action_url="https://www.sandbox.paypal.com/cgi-bin/webscr";


//Make your own script language! Please send your custom language pack (not listed on our site) and you will get free gift from us - latest version of shoping script.


?>
