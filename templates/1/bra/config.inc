<?php
$post_method="POST";
$allow_complex=0; //allow complex order
$allow_one=1; //allow simple order
$inbox=26; //q-ty of goods in box (column number in a database)
$box_volume=18; //box volume (column number in a database)
$user_volume=20; //user volume (column number in users.txt)
$user_pass_complex=20;//password for complex carts (column number in users.txt)
$k1=0.8; //empirical factor capacity for storage
$oficial_name="$shop_name"; //only slashed quotes inside
$oficial_adress="São Paulo";
$oficial_phone="$telef";
$oficial_logo="$shop_name";
$oficial_stamp="";
$mod_rw_enable=0; //enable(1) or disable(0) mod_rewrite catalogues
//whois service
$ripe_adr="whois.ripe.net";
$ripe_port=43;
$ripe_timeout=5;
if (!isset($_SESSION["user_currency"])){ $okr=$currencies_round[$defvalut]; } else { $okr=$currencies_round[$_SESSION["user_currency"]]; }

//Brazil language Pack

$zak_po="Atendimento: De Seg. à Sex. das <b>8h às 12h </b> e das <b>13h às 18h</b>";

$dost_naim1="<br><small>Entrega custo: ";

$dost_naim2="<br><small>LIVRE entrega (Custo total >";

$lang=array (

'poluchatel'=>"JSC XXXXXXX",

'bank'=>"VT Banco",

'rs' =>"40802810518000000000",

'ks' =>"40802810518000000001",

'bik'=>"044525000",

'mainsite'=>"Home",

'webshop'=>"Guardar",

'prebuy'=>"Não vendas",

'buy'=>"Adicionar ao carrinho",

'root_directory'=>"Root Directory",

'back_to_higher_level'=>"Voltar!",

'sort_by'=>"Ordenar por",

'by_name'=>"Nome",

'by_price'=>"Preço",

'by_date'=>"Data",

'by_pcs' =>"Estoque",

'down'=>"Ascendente",

'up'=>"Descendente",

'addition'=>"Mais informações",

'click'=>"Clique aqui para obter mais informações",

'file'=>"Item",

'no_foto'=>"Sem foto",

'no_description'=>"Sem descrição",

'description'=>"Descrição",

'exists' =>"Existe",

'not_exists' =>"Não existe",

'already'=>"Já",

'hack'=>"Hack Atempt? <br> <br> Proibido!",

'to_admin'=>"Por favor, entre em contato com o administrador.",

'html_tags' =>"Tags HTML",

'enter'=>"Para usuários registrados",

'login'=>"Seu ID",

'pass' =>"Senha",

'del'=>"Apagar",

'clear'=>"Limpar",

'edits' =>"Editar",

'undo'=>"Cancela",

'sendform'=>"Enviar",

'search'=>"Pesquisa",

'query'=>"Palavras-chave",

'back'=>"Voltar",

'file_list'=>"Itens encontrados",

'keyword'=>"Palavra-chave",

'indexator'=>"Indexação. Aguarde!",

'last_index'=>"Data da última indexação:",

'total'=>"Total objetos",

'total_dirs'=>", Categorias: ",

'total_files'=>", Itens: ",

'index_ok'=>"Sucesso indexação.",

'index'=>"Indexador de arquivo",

'creation'=>"Criação",

'pcs' =>"Un",

'qty'=>"QTD",

'price'=>"Preço",

'info'=>"Item",

'subtotal'=>"Subtotal",

'id'=>"ID",

'exit'=>"Logoff",

'ch'=>"Alterar",

'welc'=>"Bem-vindo",

'thnk'=>"Obrigado visitou-nos de novo!",

'yourstat'=>"Você Status:",

'adm1'=>"Indexação seções",

'adm2'=>"Itens Administração",

'adm3'=>"CMS",

'adm4'=>"Orders",

'adm5'=>"Usuários",

'adm6'=>"Fórum Administrativo",

'adm7'=>"Modelos",

'adm8'=>"Línguas",

'adm9'=>"Principal modelo",

'adm10'=>"Proteger / ADMIN diretório",

'adm11'=>"Indexando textos para pesquisa",

'buyes' =>"Você comprou:",

'all_items' =>"Categorias:",

'edit_templates' =>"Modelos Editor",

'list_templates' =>"Lista de modelos:",

'regtext'=>"Uma vez cadastrado, você pode entrar na loja sob o seu próprio ID e senha e você não precisa  voltar a preencher formulários em qualquer das seguintes compras. Somente usuários registrados podem receber descontos adicionais e gratificações.",

'themes' =>"Imagen",

1 =>"Serviços",

2 =>"Itens fotos por nome",

3 =>"Database Backup",

4 =>"Custom Menu",

5 =>"Pesquisar e Substituir",

6 =>"Diretórios Pics",

7 =>"Guardar",

8 =>"Comentários",

9 =>"Orçamento",

10 =>"Modelos",

11 =>"Cores do site",

12 =>"Muito importante",

13 =>"Estatística",

14 =>"Proibidas",

15 =>"Limpar estatística",

16 =>"Stock Indexação",

17 =>"Stock Analítica",

18 =>"principal Stock",

19 =>"SEO",

20 =>"Mailing list",

21 =>"Links Page",

22 =>"Formulário Editor",

23 =>"Gerador de linkexschange",

24 =>"FTP intercâmbio",

25 =>"Configurar FTP troca",

26 =>"Executar FTP troca",

27 =>"Importar de mesma base",

28 =>"Recursos adicionais",

29 =>"Excluir todos os itens",

30 =>"Acesso Permitido",

31 =>"Carrinho",

32 =>"Itens",

33 =>"Total",

34 =>"Total com entrega",

35 =>"Carrinho",

36 =>"Seu ID",

37 =>"Seu ID deve conter os caracteres permitidos e têm uma duração de 3-12 caracteres!",

38 =>"Sua senha deve conter os caracteres permitidos e têm uma duração de 3-12 caracteres!",

39 =>"Registrar",

40 =>"Carrinho de Compras está vazio",

41 =>"Pedido indisponível",

42 =>"Erro",

43 =>"Após a confirmação do pagamento, iniciaremos a produção.",

44 =>"Erro ao abrir o arquivo",

45 =>"ao escrever o ficheiro",

46 =>"Ajuda",

47 =>"Preço",

48 =>"Novos clientes",

49 =>"Por favor",

50 =>"Registro",

52 =>"para guardar informações pessoais",

53 =>"Sua Informação Pessoal",

54 =>"Contato",

55 =>"Sobre",

56 =>"Notícias",

57 =>"Compras Script License Pedido",

58 =>"Enviada com sucesso! Se tiver comprado legalmente o script aguarde uma carta com um código de registro.",

59 =>"Ir ao caixa",

60 =>"Administração",

61 =>"estação de metrô mais próxima",

62 =>"Se encomendar algo de um certo tamanho, em seguida, introduza aqui o tamanho desejado, você pode especificar aqui a data desejada e tempo de entrega e como obter rapidamente a você (a partir da estação de metrô mais próxima).",

63 =>"Como obter rapidamente a você",

64 =>"",

65 =>"CEP",

66 =>"",

67 =>"",

68 =>"Casa número",

69 =>"",

70 =>"Você não especificado",

71 =>"Endereço",

72 =>"Cidade",

73 =>"Telefone",

74 =>"Seu Nome",

75 =>"Nome",

76 =>"Nickname (ID)",

77 =>"Cliente",

78 =>"Livre entrega só em Londres",

79 =>"Por favor especificar, se não na lista",

80 =>"Eu concordo com os Termos e Condições <b> </ b> da loja (ver abaixo) e aceitá-la.",

81 =>"Os campos obrigatórios",

82 =>"Depois de pressionar o botão, você envia uma solicitação ao nosso gerente, que entrará em contato com você durante as horas de trabalho para confirmar o pedido e determinar a data e hora da entrega. Também a cópia da decisão será enviada para o e-mail. ",

83 =>"Entrar sinais especificados na imagem",

84 =>"Antispam recurso",

85 =>"Mensagem",

86 =>"Esqueceu sua senha?",

87 =>"Para restaurar a senha, digite o endereço que você especificou durante a inscrição",

88 =>"Restaurar conta senha",

89 =>"Após digitar o endereço correto o sistema irá alertá-lo sobre a operação se sucesso ou não.",

90 =>"Enviar senha",

91 =>"Este endereço de e-mail não é registrado no sistema. Digite o e-mail correto.",

92 =>"<b> Senha enviada com sucesso para o seu E-mail </ b> <br> você irá recebê-lo dentro de 1-10 minutos <br> verificar seu e-mail e utilizar e-mail User ID e senha para fazer logon. ",

93 =>"Não itens encontrados contendo a sua pesquisa",

94 =>"Não encontrado",

95 =>"Cor:",

96 =>"<br> Material: couro natural (Itália)",

97 =>"Adicionar a Favoritos",

98 =>"Definir como Home Page",

99 =>"A partir de",

100 =>"-",

101 =>"Qualquer",

102 =>"Escolha dos preços",

103 =>"Procurar nesta categoria",

104 =>"Página Passar",

105 =>"Páginas",

'name'=>"Nome",

106 =>"Versão para impressão",

107 =>"Escolha o seu apelido (ID)",

108 =>"Sua conta privada",

109 =>"Escolha uma senha",

110 =>"Esqueceu login ou senha?",

111 =>"Se você já e cadastrado e esqueceu a sua identidade (apelido) ou a senha você pode <b> <a href=index.php?action=restore> restaurar sua conta </a> </b> digite seu e-mail. ",

112 =>"Re-digite a senha",

'citys' =>"São Paulo",

'choose'=>"Escolha",

113 =>"Usuário com o mesmo apelido (ID) já existe. Escolha outro apelido (ID)",

114 =>"Hoje",

115 =>"Janeiro",

116 =>"Fevereiro",

117 =>"Março",

118 =>"Abril",

119 =>"Maio",

120 =>"Junho",

121 =>"Julho",

122 =>"Agosto",

123 =>"Setembro",

124 =>"Outubro",

125 =>"Novembro",

126 =>"Dezembro",

127 =>"Links",

128 =>"Definições de Vendas",

129 =>"Limpar o espaço em disco",

130 =>"Procurar Duplas",

131 =>"Indexação TOP10",

132 =>"Nuvem Tag Editor",

133 =>"Indexação Tag Cloud",

134 =>"Custom Pedido documento",

135 =>"Configurações principais",

136 =>"Gráfico Skins",

137 =>"Criar cópia item",

138 =>"Outras fotos",

139 =>"Ampliar fotografia",

140 =>"Clique nas fotos para ampliar",

141 =>"Os itens encontrados por palavra-chave:",

142 =>"Finalizar Pedido",

143 =>"Data e hora atual",

144 =>"Saída Complexo Pedido",

'Sun'=>"Dom.",

'Mon'=>"Seg.",

'Tue'=>"Ter.",

'Wed'=>"Qua.",

'Thu'=>"Qui.",

'Fri'=>"Sex.",

'Sat'=>"Sáb.",

145 =>"Enviar pedido",

146 =>"Você digitou errado o antispam código? Digite o código válido mostrado na foto!",

147 =>"Você não concordar com os termos e condições. Não há nenhuma maneira para enviar-lo sem fim.",

148 =>"Preço por atacado",

149 =>"Preço de varejo",

150 =>"Você deve especificar um e-mail correto",

151 =>"Não encontrado @ sinal.",

152 =>"Acesse @ deve estar no meio de e-mail",

153 =>"Acesse @ deve estar no meio de e-mail, e não no final.",

154 =>"Erro e-mail.",

155 =>"Você deve especificar domínio desconhecido. Você deve entrar válido pós domínios:",

156 =>"Endereço de entrega:",

157 =>"Código",

158 =>"Título",

159 =>"Telefone código de área",

160 =>"Modo de Pagamento",

161 =>"Modo de Entrega",

162 =>"Próxima página",

163 =>"Página anterior",

164 =>"Home",

165 =>"Preço escolhidos com modos de pagamento e entrega",

166 =>"",

167 =>"Estado",

168 =>"Você usou os caracteres proibidos de",

169 =>"Tipo de propriedade",

170 =>"Stock",

171 =>"Tag nuvem",

172 =>"Novo!",

173 =>"Em Stock encontrado:",

174 =>"No estoque:",

175 =>"Não há itens",

176 =>"Você Preço:",

177 =>"Você já escreveu este comentário! não enviá-lo duas vezes! ",

178 =>"Referência links de comentários Proibido!",

179 =>"Você não tem direitos para criar comentários!",

180 =>"Você será o primeiro a rever este ponto!",

181 =>"Comentários Limpo.",

182 =>"Comentários Mudado.",

183 =>"Editar Comentário:",

184 =>"Apenas para administradores",

185 =>"Apagar todos os comentários",

186 =>"Banir IP",

187 =>"Tocar Tudo",

188 =>"Sem foto",

189 =>"max: 1000 símbolos",

190 =>"máx: 50 símbolos",

191 =>"Texto",

192 =>"Deixe a sua opinião sobre o produto:",

193 =>"Convidado",

194 =>"Os mesmos itens",

195 =>"Procurar:",

196 =>"Color",

197 =>"Material",

198 =>"Vendendo Início:",

199 =>"Item balcão:",

200 =>"Compradores opiniões:",

201 =>"Todos os itens",

202 =>"Número não encontrado",

203 =>"Páginas:",

204 =>"Visto a partir de",

205 =>"a",

206 =>"Total:",

207 =>"Itens",

208 =>"adicionado com êxito ao carrinho de compras.",

209 =>"Sucesso!",

210 =>"Erro ao adicionar produto ao carrinho!",

211 =>"Atenção!",

212 =>"Você tem guardado última cesta",

213 =>"Desde a sua última visita ao preço desses produtos, descontos e por isso pode mudar. Este produto pode até ser removido de venda. Pode tentar adicioná-lo ao seu atual cabaz (com base em preços correntes), ou você pode anular esta lista e adicionar novos produtos em seu carrinho de compras. ",

214 =>"Ver última cesta",

215 =>"Caixas",

216 =>"Busto de um maior número de caixas, no valor de:",

217 =>"Valor",

218 =>"Partes",

219 =>"Preço mostrados com descontos",

220 =>"Você deve digitar apenas os seguintes sinais:",

221 =>"Sem título",

222 =>"Não está na venda, e não será adicionado ao cesto!",

223 =>"Talvez a mercadoria tinha sido mudado ou mudou o seu código.",

224 =>"Na caixa",

225 =>"Aumentar o número de encher as caixas",

226 =>"Reduzir para encher as caixas",

227 =>"Seu pedido contém um número de caixas fracionada. <br> Mude seu pedido para o valor inteiro de caixas",

228 =>"Você não totalmente editado. Edite forma completamente a cada produto nome colocado para número inteiro de caixas (ver abaixo).",

229 =>"Partes",

230 =>"Tome outro",

231 =>"ou remover",

232 =>"ou remover a linha pressionando o [x]",

233 =>"VISITE OUTRAS SEÇÕES!",

234 =>"Caros clientes VIP, para obter o nosso cartão de descontos!",

235 =>"Todos os preços nas lojas convertidas em um desconto. Após a adição de mercadorias para o carrinho de compras - digite os dados para entrega do formulário que aparece durante o processo de encomenda.",

236 =>"Nossas promoções especiais:",

237 =>"Remover todas as ofertas",

238 =>"Clique aqui se você estiver matriculado, mas não se lembra as informações da sua conta",

239 =>"Lista dos últimos 5 ordens:",

240 =>"Complexo fim",

241 =>"Aviso!",

242 =>"Neste momento, um dos empregados da sua empresa de transformação a etapa final de Complexo pedido. <br> Neste caso, Complexo pedido está temporariamente bloqueada. Se quiser complementar a já estabelecida o pedido, entre em contato com o empregado para solicitar um pedido de voltar à fase de edição. <br> Caso contrário, você terá de esperar para processar o seu pedido mais tarde. ",

243 =>"Não processados",

244 =>"Pedido",

245 =>"Antes do fim Carrinho complexas serão apurados.",

246 =>"Depois que - o seu navegador irá transmitir-lhe um tratamento Complexo pedido. <br> Se não, clique no botão",

247 =>"Link",

248 =>"Selecione uma seção de ofertas especiais:",

249 =>"Todas as seções",

250 =>"Removida diz:",

251 =>"Os arquivos de ofertas especiais não encontrado!",

252 =>"Arquivo não encontrado:",

253 =>"O conteúdo das anteriores, não enviar pedido",

254 =>"Limpo",

255 =>"Adicionar ao carrinho desses itens",

256 =>"Este conteúdo será automaticamente apagada se a sua nova compra",

257 =>"Apagar um arquivo:",

258 =>"Novas ofertas especiais",

259 =>"Novos Produtos",

260 =>"Os artigos:",

261 =>"Habilitar ativação",

262 =>"Agora você pode inserir um nome de usuário e senha especificado na carta ao entrar na loja. <br> <br> Então, o sistema irá lembro de você e você será capaz de receber bónus e descontos para os seguintes ordens",

263 =>"Activação o usuário tenha sucesso!",

264 =>"O usuário já foi activado! <br> Reativar impossível.",

265 =>"Você não tem direitos suficientes para administrar o fórum.",

266 =>"Foi um pedido de senha recuperação / Site:",

267 =>"Para entrar, use as seguintes informações:",

268 =>"Não responda a esta mensagem!",

269 =>"Se você acredita que a carta tem a você em erro, por favor, apagá-lo e entre em contato com o administrador do site.",

270 =>"Com melhores desejos,",

271 =>"O carrinho módulo não é licenciado!",

272 =>"Você pode ativar este módulo através da compra de uma licença.",

273 =>"Você já vistos:",

274 =>"Nosso TOP-10",

275 =>"Sem um modelo",

276 =>"Principais ofertas",

277 =>"Preço",

278 =>"Preço antigo",

279 =>"Se você mudar a quantidade de produtos na cesta - imprensa <b> Recalcular </b> botão na parte inferior da página para confirmar esta ação!",

280 =>"Página temporizador",

281 =>"Código único",

282 =>"Lista de pedido",

283 =>"ENTER AO CÓDIGO DE LICENÇA",

284 =>"Arquivo de Notícias",

286 =>"Popular tag",

287 =>"Qtd de consultas",

288 =>"Você é:",

289 =>"Avançar",

290 =>"Saída sem registro",

291 =>"Sistema de metrô",

292 =>"Concluído",

293 =>"",

294 =>"Preço alterado desde a sua visita anterior.",

295 =>"Preço antigo:",

296 =>"Novo preço:",

297 =>"Produto adicionado ao cesto com um novo preço.",

298 =>"Senha e Confirmar senha - não correspondem",

299 =>"Erro na entrada de dados",

300 =>"Proibido uso de símbolos",

301 =>"No campo",

302 =>"Inaceitável",

303 =>"Usando mais de um personagem",

304 =>"proibidos ou a utilização de símbolos. Você pode utilizar letras do alfabeto latino.",

305 =>"Você link para outro site, é proibida a lidar com spam",

306 =>"A mensagem está vazia ou contém uma má palavra. Não vai ser enviado.",

307 =>"Você pode nos enviar uma mensagem:",

308 =>"Jogos encontrado:",

309 =>"Encontrado no texto:",

310 =>"Pedido",

311 =>"Encontrado",

312 =>"O comprimento de palavras na consulta deve ser superior a 2 caracteres e pode conter apenas letras Russo e Inglês, assim como ponto e figura!",

313 =>"Sua cesta contém itens em outra moeda que não o produto que você tentou comprar. <br> Várias moedas operações não são suportadas - escolher os itens de uma moeda. <br> <br> Para comprar este produto - você deve",

314 =>"Limpar carrinho de compras",

315 =>"Depois que a operação pode colocar este item no carrinho de compras. Você pode colocar a mesma moeda itens no carrinho de compras.",

316 =>"Sua cesta contém itens em outra moeda que não itens nesta seção, portanto, é impossível calcular o custo de entrega, etc Por favor, vá até a loja seção onde os bens indicados na mesma moeda.",

317 =>"Com sucesso mudou!",

318 =>"As mudanças no modelo tags",

319 =>"Pode conduzir a resultados imprevisíveis",

320 =>"O conteúdo do modelo",

321 =>"Conectar a uma base de dados de Internet-shop",

322 =>"Restaurar dados",

323 =>"Obrigado",

324 =>"Sua mensagem foi enviada",

325 =>"Responderemos o mais breve possível.",

326 =>"Pedido confirmado!",

327 =>"Consulte o andamento do seu pedido em home e click em (Consultar Pedido).",

328 =>"Você tem aplicado para o registro.",

329 =>"Para completar inscrição, você deve clicar no link",

330 =>"Ativar agora!",

331 =>"Uma vez ativada, você pode vir para a nossa loja usando os seguintes dados",

332 =>"Obrigado! Você criou um novo tópico no fórum!",

333 =>"Obrigado! Sua resposta é postada no fórum!",

334 =>"Você usou o proibido tags no assunto ou mensagem!",

335 =>"Agora você será redirecionado para a lista de tópicos.",

336 =>"Se isso não acontecer dentro de 2 segundos, você pode clicar sobre este",

337 =>"Registro data",

338 =>"Email não pode iniciar a partir do ponto símbolo",

339 =>"O ponto símbolo não pode seguir imediatamente após o símbolo",

340 =>"Não basta pontos após o símbolo",

341 =>"Email não pode terminar no ponto em símbolo.",

342 =>"Por favor não apague este e-mail! Pode ser útil!",

343 =>"Obrigado por se registar",

344 =>"Você pode vir para a nossa loja com os seguintes dados",

345 =>"No especificado E-mail enviado com um link, clique para confirmar

seu cadastro.",

346 =>"Aplicação aprovado.",

347 =>"Acordo. Termos e Condições.",

348 =>"Você tem ordenados:",

349 =>"Total itens:",

350 =>"O número total de unidades:",

351 =>"Bens recebidos familiarizado com termos, alega não ter qualquer aparência:",

352 =>"Dados enviados para o seu e-mail.",

353 =>"Unique carta código:",

354 =>"Fatura foi criada com êxito",

355 =>"",

'recalc'=>"Recalcular",

'add'=>"Adicionar",

356 =>"Adicionar tópico",

357 =>"Seu Nome",

358 =>"Nome do Tema",

359 =>"Adicionar resposta",

360 =>"Por favor, indique tópico nome!",

361 =>"Por favor introduza o seu nome!",

362 =>"Introduza texto você!",

363 =>"Autor",

364 =>"Tema descrição",

365 =>"Respostas",

366 =>"Último",

367 =>"Criar tópico",

368 =>"Tema",

369 =>"Tópico não criou!",

370 =>"Sua resposta adicionado!",

371 =>"Data",

372 =>"Ações",

373 =>"Tópico apagado!",

374 =>"Apagado Resposta!",

375 =>"Apenas administradores",

376 =>"Acesso concedido!",

377 =>"Login ou senha do usuário não é permitido!",

378 =>"Sair sucesso!",

379 =>"Sair",

380 =>"Consultar pedido",

381 =>"Usuário com este login já existe!",

'weight'=>"Peso",

'subtotalweight'=>"Subtotal peso",

'totalweight'=>"Total de peso",

'volume'=>"Bônus",

'subtotalvolume'=>"Subtotal bônus",

'totalvolume'=>"Bônus total",

'delivery'=>"O pagamento e entrega",

382 =>"Pastas editor.",

383 =>"Excluir arquivos",

384 =>"Adicionar arquivo",

385 =>"Editar o arquivo",

386 =>"Ocultar arquivos",

387 =>"Exibir arquivos",

388 =>"Arquivo oculto",

389 =>"Copiar para a memória",

390 =>"Renomear",

391 =>"Apagar utilizador",

392 =>"Introduza por este usuário",

393 =>"Não disponível",

394 =>"Usuário não entrará no caso de Apagar utilizador info",

395 =>"Perfil do usuário",

396 =>"Tipo de usuário",

397 =>"Status",

398 =>"Usuários não encontrado",

399 =>"Incluem novatos",

400 =>"NB",

401 =>"Novato não na lista (users.txt)",

402 =>"Utilizadores registados nos ficheiros personalizados (userstat / userlogin.txt)",

403 =>"Plenos direitos usuários",

404 =>"Personalizados direitos utilizadores",

405 =>"Função não funcionou agora",

406 =>"Grosso usuários",

407 =>"Usuários com inicialização direitos",

408 =>"Apenas os usuários com status: <b> ADMIN </ b> pode mudar usuário estatuto <br>",

409 =>"Usuário carrinhos de compras não encontrado",

410 =>"Última itens",

411 =>"24H Online!",

412 =>"Avatara Eva Admin",

413 =>"Pergunte a nossa atendente eletrônica Eva.",

414 =>"Posso ajudar?",

415 =>"Não respondeu a perguntas",

416 =>"Eve Talking teste",

417 =>"Outras",

418 =>"Arquivo",

419 =>"Item Código",

420 =>"Todos",

421 =>"Fotografia",

422 =>"Ver todos",

423 =>"Ver Simples",

424 =>"Ver Extensão",

425 =>"Ver Como mesa",

426 =>"Exibir",

427 =>"Venda",

428 =>"Fechar a janela",

429 =>"Nenhuma forma de utilizar mor do que <b> 99999 </b> itens. Contato autor.",

430 =>"Categoria",

431 =>"Subcategoria",

432 =>"Copiar sucesso",

433 =>"Tem certeza de copiar este item?",

'yes' =>"Sim",

'no'=>"Não",

434 =>"Item com este ID não encontrado!",

435 =>"Editar item novo nome e número ID, se você desejar. Também você pode mudar da categoria e subcategoria. Vão ser criado se não existe. Por favor, não use símbolos anormal.",

436 =>"Último item dont deseja apagar !!!",

437 =>"Apagado sucesso",

438 =>"Nenhuma forma de restaurar",

439 =>"Tem certeza de apagar este item?",

440 =>"Fechar a janela e vá para a sub-categoria",

441 =>"Você irá automaticamente para o número Ir categoria (se você editar a nova categoria), caso não queira ir para essa categoria e quero ficar apenas fechar a janela, pressionando [X] botão no topo da janela",

442 =>"Deletting Sub Categoria",

443 =>"Tem a certeza de eliminar todos os produtos nesta sub-categoria?",

444 =>"Carregar / escolhendo pequenas imagens da galeria de fotos",

445 =>"Carregar / escolhendo grandes imagens de galeria de fotos",

446 =>"Limpar forma de grandes fotos",

447 =>"Criado em nova categoria",

448 =>"Item carrinho",

449 =>"Um.",

'short'=>"Breve descrição",

'artlink'=>"O artigo número ou site dirtectory (ex. a0001 ou ./mp3/dir)",

'kwrds' =>"Vendas (ex. 10%), palavras-chave (ex. plasmatv) e opções (ex. option1)",

450 =>"Se você sabe o número do pedido e E-mail, especificadas na encomenda - isto permitirá que você descubra a fase do pedido.",

451 =>"Os usuários registrados podem pesquisar o conteúdo eo estatuto das encomendas anteriores.",

452 =>"Se você fizer uma forma sem registro - você pode ver apenas o estado de execução das suas encomendas para este efeito no formulário, digite o número do pedido e de seu E-mail (que você especificou no momento da matrícula, do pedido)",

453 =>"Por favor digite apenas números",

454 =>"Número do pedido",

455 =>"Confirmar",

456 =>"Usuário informação atualizada.",

457 =>"Não é válido o número do pedido",

458 =>"Os resultados do controle",

459 =>"E-mail especificado no cadastro não coincide com o seu. Mostra o estatus do pedido não e possível por razões de segurança. Indique E-mail, listado no pedido para ver seu estatus",

460 =>"Editar dados do usuário",

461 =>"Order Not Found",

462 =>"Quem é o beneficiário do pedido?",

463 =>"Identificação",

464 =>"Para usuários registrados",

465 =>"Se você se lembra do seu login e senha e, em seguida, introduzi-los nos campos apropriados:",

466 =>"Continue Checkout",

467 =>"Para os novos usuários",

468 =>"Você também pode colocar um fim sem registro. Sem registro você não será capaz de monitorar o estado das suas encomendas e serão privadas de outras amenidades. Quer colocar um fim sem registro?",

469 =>"Saída sem registro",

470 =>"Confirmar usuário",

471 =>"Selecione ...",

472 =>"Selecione ...",

473 =>"",

474 =>"Outras cidades ...",

475 =>"Outras estação ...",

476 =>"Pague através de:",

477 =>"Visto",

478 =>"MasterCard",

479 =>"American Express",

480 =>"Banco",

481 =>"Secure transação",

482 =>"<h4> Atenção! </h4> Seu PEDIDO terá a produção iniciada após a confirmação do

pagamento pelo financeiro, caso queira acelerar o processo nos envie o comprovante de

pagamento com o número do pedido. <br> <u> <b> Consulte o andamento do seu pedido em

consultar pedido! </b> </u> <br><br>",

483 =>"Após a verificação do pagamento enviaremos um e-mail com a confirmação.",

484 =>"Você pode pagar seu pedido agora.",

485 =>"RECUSAR",

486 =>"produto defeituoso",

487 =>"Entregue",

488 =>"Recebidos (Mail)",

489 =>"Receita",

490 =>"Out of Stock",

491 =>"Não administrar",

492 =>"Apagar",

493 =>"Eliminado",

494 =>"Despesas",

495 =>"Salário",

496 =>"Tel custos",

497 =>"Mob tel",

498 =>"Internet",

499 =>"Sobretaxa",

500 =>"Transportes",

501 =>"Compras",

502 =>"Vendido",

503 =>"Aviso Geral",

504 =>"Aplicação",

505 =>"Mail",

506 =>"Processamento",

507 =>"Pagamento Pendente",

508 =>"Todos os disponíveis",

509 =>"Enviado (Mail)",

510 =>"Concretizar",

511 =>"Exchange",

512 =>"Adiada",

513 =>"Voltar",

514 =>"Return (quase)",

515 =>"Payment for goods",

516 =>"",

517 =>"",

518 =>"",

519 =>"O pagamento de outras moedas",

520 =>"Pay",

521 =>"Favoritos cor",

522 =>"Esta página pode ser atualizado",

523 =>"Definir Autorefresh desta página",

524 =>"sec",

525 =>"min",

526 =>"Salvar uma base de dados de encomendas",

527 =>"Salvar",

528 =>"(utilizado apenas em casos urgentes!)",

529 =>"Não atualizar a página depois de enviar dados !!!",

530 =>"Custo",

531 =>"Soma",

532 =>"Histórico",

533 =>"Courier / data",

534 =>"This Week",

535 =>"Ver",

536 =>"Todas as ordens",

537 =>"Janeiro",

538 =>"Fevereiro",

539 =>"Março",

540 =>"Abril",

541 =>"Maio",

542 =>"Junho",

543 =>"Julho",

544 =>"Agosto",

545 =>"Setembro",

546 =>"Outubro",

547 =>"Novembro",

548 =>"Dez",

549 =>"Para atualizar a página usar o link",

550 =>"Não use o botão Voltar do navegador!",

551 =>"Mês",

552 =>"Gráfico",

553 =>"Pedidos",

554 =>"Rejeitado",

555 =>"Entregue",

556 =>"Rendimento",

557 =>"GRAPH para dinheiro",

558 =>"Não processado ordens",

559 =>"Total entregues",

560 =>"Entregue este mês ordens",

561 =>"Ordens",

562 =>"Courier",

563 =>"Entrega",

564 =>"Prompt de estado",

565 =>"Na previsão dos lucros e das despesas",

566 =>"Correio recebido para entrega",

567 =>"Correio não recebidos por transferência",

568 =>"Lucro",

569 =>"Ignorado",

570 =>"Realce roxo",

571 =>":",

572 =>"Max Qtd de ordens",

573 =>"Sem a rejeição",

574 =>"Pesquisa de dados cliente",

575 =>"Entregue",

576 =>"Nós",

577 =>"Clientes",

578 =>"Atacadista preço",

579 =>"Para os atacadistas",

580 =>"Info",

581 =>"Filtro",

582 =>"Estatísticas de vendas mensal",

583 =>"Contabilização de sucesso apenas ordens",

584 =>"Prognóstico",

585 =>"A previsão de receitas",

586 =>"Prognóstico pagar o courier",

587 =>"Total receitas",

588 =>"Não encontrou nenhuma pedido",

589 =>"O novo estatus do seu pedido",

590 =>"Data mudanças do estatus",

591 =>"Apresentada pelo correio",

592 =>"Não há necessidade de enviar os dados de novo!",

593 =>"Já tiver sido atribuído",

594 =>"Após 5 segundos você será redirecionado para uma lista de encomendas. <br> <br> Aguarde",

595 =>"Custo de entrega",

596 =>"de",

597 =>"a",

598 =>"Pedido transferidos para a nova data",

599 =>"Código",

600 =>"Closing semana abaixo",

601 =>"Erro ao copiar o arquivo",

602 =>"Backup OK",

604 =>"Semana fechada. <br> <br> Aguarde 3 segundos. Você será redirecionado para uma lista de encomendas",

605 =>"Alterar as despesas",

606 =>"Alterar a compra",

607 =>"Alterar o número postais",

608 =>"Você pode controlar o seu selo sobre a ligação",

609 =>"Seu pacote",

610 =>"Número de designadas postais",

611 =>"ERRO ENTRADA DE DADOS. Incorrect data destino.",

612 =>"Alterar Número postal",

613 =>"SEMANA Fechado",

614 =>"Fechar a Semana",

615 =>"Tem certeza? Você não pode modificar os dados na semana encerrada. Rollback não é possível! ",

616 =>"Histórico das despesas",

617 =>"Adicionar despesas",

618 =>"Problema Popular",

619 =>"Semana",

620 =>"Bilhete",

621 => "Não disponível",

622 => "único item",

623 => "Muito pouco",

624 => "Em quantidades limitadas",

625 => "Disponível",

626 => "Uma série de itens",

627 => "Programa de afiliados",

628 => "Por favor, leia o acordo de parceria a seguir",

629 => "Se você concorda com estes termos, você pode se registrar como um parceiro",

630 => "Escolher um parceiro de qualquer identificador, como o nome do site, que será criado códigos de parcerias. É permitido usar apenas números, letras do alfabeto latino, um sublinhado, hífen e ponto. Exemplo:",

631 => "Se for permitido pelo administrador do site - todos os parceiros será enviado automaticamente pedidos para o e-mail",

632 => "Escreva uma breve descrição do seu site, e também especificar se aqui a execução de qualquer código HTML ou PHP, quando você envia uma pedido de parcerias. Por favor, não escreva o código HTML aqui.",

633 => "Essa identificação é sócio já existe, por favor especifique outro ID!",

634 => "Agora você pode participar do nosso programa de afiliados.",

635 => "Você pode instalar nossos banners de publicidade e links para seu site com a seguinte URL:",

636 => "Neste caso, todas as ordens recebidas a partir do seu site, este link será tida em conta. Além disso, esses pedidos serão enviados automaticamente para seu e-mail, se permitido pelo administrador do site",

637 => "Se você deseja definir o código HTML ou PHP, que irá registrar automaticamente este pedido nos sistemas de outros parceiros em nosso site - você entrará em contato com o administrador do nosso site. Nesse caso - você envia o código para verificar a sua segurança. Então - ele será instalado. ",

638 => "Para ler os nossos acordo de parceria, por favor clique no link abaixo:",

639 => "Acordo de Parceria",

640 => "Você também pode instalar o Java janela para o seu site com os produtos do nosso catálogo.",

641 => "Para fazer isso você precisa inserir o seguinte código HTML em suas páginas:",

642 => "Você pode ver todo o produto do nosso catálogo ou apenas algumas seções. Entre em contato com o administrador do site para aprender a fazê-lo.",

643 => "Se você tiver alguma dúvida, entre em contato com o e-mail:",

644 => "Essas informações e contato com o administrador enviado ao seu e-mail especificado",

645 => "Email de contato:",

646 => "Seu erro:",

647 => "Você mudou os parâmetros básicos:",

648 => "Valor",

649 => "Não é um orçamento fechado. Edite o valor!",

650 => "String.",

651 => "Número.",

652 => "Um novo link",

653 => "Palavra",

654 => "Adicionar um novo link no menu",

655 => "Substituição",

656 => "Compromisso",

657 => "Substituído",

658 => "Você fez a substituição! base reindexar Obrigatório.",

659 => "A substituição global no banco de dados",

660 => "Por sua própria conta e risco!",

661 => "Nós recomendamos que fazer",

662 => "Substituir",

663 => "Substituir",

664 => "Seção Escolha",

665 => "Imagens Pequenas",

666 => "Mais imagens ",

667 => "Marca",

668 => "Link para o artigo",

669 => "Descrição completa",

670 => "Quantidade Disponível",

671 => "Em todos os lugares",

672 => "Renomeando seções / subseções",

673 => "Renomear",

674 => "Editar e pressione OK ",

675 => "Lista de catálogos de produtos",

676 => "Especifique o desconto sem o sinal de porcentagem",

677 => "Código de cores selecionadas",

678 => "Ver favoritos",

679 => "Código de cores HEX",

680 => "Duplicado produtos não encontrado!",

681 => "O Classificação comprador médio",

682 => "Ver comentários",

683 => "Seu Voto",

684 => "Por favor, classifique este produto em um sistema de 5 pontos",

685 => "Classificar",



686 => "Os números indicam a ordem das seções e subseções",

687 => "Pedido ",

688 => "Tem de especificar um URL de banners em sites parceiros para explicar as transições",

689 => "Não especificada e-mail (use um 0-9a-zA-Z _-) ou o nome do parceiro (use 0-9a-zA-Z _-)",

690 => "Adicionar um novo parceiro",

691 => "Exemplo",

692 => "Use somente letras, dígitos, hífen, período e sublinhado underwear",

693 => "Este código será exibido após concluir seu pedido, pode ser Java script, gravando o fim de outro sistema de afiliados Se você quer apenas enviar o pedido para E-mail parceiros -. deixe este campo em branco.",

694 => "Utilização de modelo",

695 => "URL do seu site",

696 => "Número de Ordem",

697 => "Preço sem entrega",

698 => "Corrente do cliente",

699 => "Cliente de e-mail",

700 => "Nome do Cliente",

701 => "Número de telefone do cliente",

702 => "Este parceiro de e-mail receberá uma cópia da parceria ordenação, se não for necessário - deixe em branco ",

703 => "Novo parceiro",

704 => "As mudanças está OK!",

705 => "Cor de fundo do corpo",

706 => "fundo da lista de itens",

707 => "Cor marcador Cesta",

708 => "Cor escura",

709 => "Cor Brilhante",

710 => "Cor do corpo de texto",

711 => "Cor de sombras",

712 => "Cabeçalho Cor 1",

713 => "Cabeçalho Cor 2",

714 => "Cor da fonte do cabeçalho",

715 => "Linha de cor no cabeçalho",

716 => "Cores utilizadas",

717 => "Atual",

718 => "Título tema",

719 => "Aplicar Cores",

720 => "Tema Excluir ",

721 => "Tema Salvar ",

722 => "Cor escolhidos",

723 => "Tema Salvar ",

724 => "Clique para aplicar",

725 => "Salvar como um novo tema",

726 => "Selecione uma célula e depois clique na cor desejada.",

727 => "Lista de sucesso protegido com uma senha!",

728 => "Conteúdo. htaccess",

729 => "Conteúdo. htpasswd",

730 => "Por favor, digite seu nome de usuário e senha",

731 => "Ver também",

732 => "Acessórios",

733 => "Outros itens do catálogo",

734 => "Favoritos",

735 => "Oferta Especial do dia",

736 => "Preço visível após o registo e verificar admin",

737 => "Usuários tem preço especial",

738 => "Galeria",

739 => "Lista",

740 => "Tipos de arquivo",

741 => "Selecionar arquivo",

742 => "Upload",

743 => "O sucesso upload para o diretório",

744 => "Excluir",

745 => "Você realmente deseja excluir a pasta e todo seu conteúdo?",

746 => "Tem certeza que quer apagar o arquivo?",

747 => "Falha ao excluir ",

748 => "Erro ao criar a pasta",

749 => "Nova Pasta",

750 => "Pasta com esse nome já existe. Especifique outro nome da pasta.",

751 => "O arquivo com esse nome já existente. Especifique um nome de arquivo diferente.",



752 => "Ordem Rápida",

753 => "Basta digitar seu nome, número de telefone e tempo desejado de entrega - o nosso operador vai chamá-lo e pedir-lhe desejou momento da entrega dos itens selecionados",

754 => "Número de telefone (com código de área)",

755 => "Data de entrega",

756 => "Somente na cidade NOSSA!",

757 => "Especifique a data de entrega personalizada e hora",

758 => "Você pode fechar esta janela.",

759 => "ERRO! VOCÊ NÃO É NECESSÁRIO PREENCHER campo!",

760 => "Não identificação do produto especificado, ou o produto não encontrado! ",

761 => "ERRO! Você NÃO escolheu qualquer produto!",

762 => "ERRO: Produto não encontrado!",

763 => "Você já enviou o pedido para chamar de volta",

764 => "Por favor não repita o seu pedido de novo! Nosso operador vai chamá-lo.",

765 => "Amanhã ",

766 => "12:00-16:00",

767 => "16:00-19:00",

779 => "12:00-19:00",

768 => "Pedido Rápido <br> deste produto",

769 => "Por exemplo: +7 (499) XXX-XXXX, +7-903-XXX-XXXX",

770 => "Data de entrega mais próximo:",

771 => "Seg",

772 => "Ter",

773 => "Qua",

774 => "Qui",

775 => "Sex",

776 => "Sab",

777 => "Dom",

780 => "Imposto",

781 => "Excl.Imp.",

782 => "Inc.Imp.",

783 => "Clique sobre a imagem desejada para inserir",

784 => "Inserir",

785 => "Por favor, não remova as imagens da galeria, no caso de utilização no site!",

786 => "Imagens por página",



787 => "Aumente o campo de entrada",

788 => "Reduzir o campo de entrada",



789 => "Avatara Base (. / Base.zip) não foi encontrado.",

790 => "Criar um novo banco de dados ...",

791 => "Pasta com o banco de dados existe.",

792 => "Suas ações",

793 => "base.zip base de extrato",

794 => "Extrair arquivos com substitua",

795 => "Compactar um banco de dados existente para base.zip arquivo",

796 => "Pergunta",

797 => "Set",

798 => "Redirecionar para site",

799 => "Lista de perguntas sem resposta (após 100)",

800 => "Esta questão já foi feita, mas Eva não é capaz de responder com precisão. Tente outra pergunta ou fazer uma pergunta mais tarde, quando o operador vai ensinar Eva, como responder a essa pergunta.",

801 => "Eva não posso exatamente responder a sua pergunta. Tente outra pergunta ou fazer uma pergunta mais tarde, quando o operador vai ensinar Eva, como responder a essa pergunta.",

802 => "Eva (pensou um pouco)",

803 => "Você não respondeu",

804 => "resposta ainda. Tente responder por si mesmo.",

805 => "Responder",

806 => "Post Reply",

807 => "A resposta exata é se você quiser corrigir - você pode alterá-lo.",

808 => "Marca",

809 => "Número de pedidos",

810 => "Link",

811 => "Não é exibida",

812 => "Não exibir a marca",

813 => "Se você quiser marcar no futuro não apareceu em uma nuvem de tags, colocado em seu número de consultas ao valor de NA e, em seguida, clique aqui",

814 => "Tag popular",

815 => "Adicionar nova tag",

816 => "Criar",
817 => "Office horas",
818 => "Fechado",
819 => "Nos fins de semana e feriados de entrega é feita somente mediante acordo com o gerente.",
820 => "Ordens executadas no fim de semana e feriados são processados &#8203;&#8203;no dia útil seguinte.",
821 => "escritório está aberto",
822 => "office não está funcionando",
823 => "escritório já está fechado no",
824 => "abre no escritório",

825 => "Você forneceu uma resposta errada à pergunta.",
826 => "Responda a pergunta",
827 => "O número de instalação",
828 => "Número da licença",
829 => "O número da licença é aceito. Obrigado por adquirir nosso produto.",
830 => "Sem um número de licença, você pode usar todos os recursos do motor, exceto a oficina de módulo.",
831 => "Para ativar o módulo, por favor ligue para nós",
832 => "Versão do Software",
833 => "Você está usando a versão mais recente",
834 => "Nova versão disponível",
835 => "ChangeLog",
836 => "Você pode liberar atualizar para uma versão mais recente por si mesmo (neste caso, você não tem garantia) ou usar um serviço pago para atualizar o seu motor para a nova versão Para obter uma nova versão -. Ligue para nós",
837 => "Lembre-se que o uso de nosso software ilegalmente - adquirida pela quebra pode levar à perda de seus dados, a inclusão de vírus, hackers e outros códigos maliciosos, que você não será capaz de controlar, a infecção de seus clientes e . acusação Somos responsáveis &#8203;&#8203;por software software roubado legalmente Comprar -. você contribui para o seu desenvolvimento e você tem o direito de um upgrade independente, livre para a última versão corrige os erros que surgiram devido à nossa falta durante todo o período de uso, livre instalação em sua hospedagem é adequado para os parâmetros do razoável apoio, aconselhamento por e-mail ou telefone durante horas e dias úteis, e assistência possíveis outras por telefone ",
838 => "A resposta do servidor de licenças",
839 => "Por favor, não enviar o código de instalação e uma lista de código licenciado em mãos erradas!",
840 => "Este domínio encontra-se em licenças de banco de dados, você pode ver quais os certificados foram gerados para este domínio e pode usar um deles (geralmente o mais tardar). Se a licença não é adequado, por favor, use o pedido de uma licença no menu admin . ",
841 => "Este domínio não é encontrado em licenças de banco de dados. Você tem 30 dias de licença de avaliação. Você pode comprar licença completa para usar o site da loja, SEM LIMITAÇÃO, como nosso cliente favorito.",
842 => "Nenhuma licença encontrado",
843 => "Expires",
844 => "Unlimited",
845 => "Avaliação Expired",
846 => "Versão de avaliação",
847 => "Sem conexão com o servidor de registro",
848 => "Não disponível",
849 => "Devido à falta de comunicação com o servidor de registro, reset licença. Por favor se conectar à Internet e obter uma licença de novo.",
850 => "Você deixou",
851 => "Dias de uso legal",
852 => "Atualizar licença. Done.",
853 => "Marca d'água Photo",
854 => "Aleatória renomear suas fotos",
855 => "Watermark",
856 => "Cor da Fonte",
857 => "Linha de texto",
858 => "Fotos sem marca d'água apenas",
859 => "Processo de TODAS as fotos",
860 => "<br><div class=round><h4><a href=index.php?action=zakaz>Ir para Ordem saída?</a></h4></div>",
861 => "Icon",
862 => "Título",
863 => "Tags ou sinônimos. Especifique um separados por vírgula, ex. <i> tag1, tag2, tag3 </ i>",
864 => "Tags",
865 => "Criar miniaturas das fotos grandes",
866 => "Tamanho máximo Miniatura",
867 => "pixels",
868 => "Marcas admin",
869 => "Recalcular preços",
870 => "Indexação RSS",
871 => "Modelo de nota fiscal",
872 => "Parceiros",
873 => "Export DB",
874 => "Import DB",
875 => "Criar novo item",
876 => "Aviso: Não criar itens com o mesmo nome e código do item!",
877 => "Criar novo item nessa categoria",
878 => "Criar descrição da categoria",
879 => "Categorias e subcategorias será criado automaticamente após seções de indexação.",
880 => "Lista de Marcas será criado automaticamente após seções de indexação. Preencha Marca no carrinho item.",
881 => "Para ver marca na lista de marcas na página principal, verifique a caixa de marca, preencha todas as informações da marca, em seguida, pressione o botão Alterar.",
882 => "Site",
883 => "Url Link",
884 => "Para editar idiomas utilizados, valores e outros parâmetros clique no botão abaixo",
885 => "Para configurar os métodos de pagamento e sistemas de distribuição, os nomes dos mensageiros e pacote de idioma atual, clique no botão abaixo",
886 => "Opção",
887 => "Mostruário: Opção de visualização",
888 => "Por favor, volte para ver o resultado depois de alterar esta opção.",
889 => "Desabilitar módulo",
890 => "Módulo de Habilitação",
891 => "&#1057;anais de RSS",
892 => "&#1057;anais de RSS e modelo de parser você pode editar aqui",
893 => "css.inc -> \ $ RSSURL",
894 => "Módulo de deficientes",
895 => "Mostruário",
896 => "Itens aleatório com a venda",
897 => "Posição",
898 => "Esquerda",
899 => "Central",
900 => "Direita",
901 => "Adicionar novidades",
902 => "Idioma Padrão",
903 => "Moeda padrão",
904 => "Preço arredondado padrão",
905 => "Instalado",
906 => "Não instalado",
907 => "Lista de pacotes de idiomas disponíveis",
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
"Senhor|1||",
"Senhora|1||",
);




$payment_metode=Array (
"Dinheiro|1|||||||",
"PagSeguro (Visa, Mastercard, ...)|1||pagseguro.php|your@email.here|BRL|0.01|CCA3859CAC814D70AFD09194A4AA8FB4|CBR|",
"Clearing (extract accounts)|1|+5%||||||",
"Payment via Bank (receipt)|1|+5%|bank.php|||||",
"Cash on delivery (via mail)|0|-150||||||",
"PayPal|1||paypal.php|dpz_1241878608_per@bk.ru|EUR|paypal|Pay via PayPal|",
"Electronic payment|0||electron.php|||||",
"Webmoney WMR|1||webmoney.php|R771486625113|WMR|wmr||",
);


$delivery_metode=Array (

"Entrega grátis em Brasília DF|1||1|||0|", //Courier
"Self get in our office|1||0|||0|",
"Russian Post|1|+500|0|http://www.russianpost.ru/portal/ru/home/postal/trackingpo|post|100|",
"DHL Worldwide|1|+500|0|http://www.dhl.com/publish/g0/en/eshipping/track.high.html#aPar0001|post|100|",
"Fedex|1|+500|0|http://www.fedex.com/Tracking?cntry_code=ru|post|100|",
"CanadaPOST|1|+500|0|https://obc.canadapost.ca/emo/basicPin.do?trackingId=[tracknum]&trackingCode=PIN&action=query&speek=en|post|100|",
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