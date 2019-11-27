<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Schopf <pschopf@gmail.com>
 */
$lang['timezone']              = 'Fuso horário usado para atualização do dia (se vazio, o fuso horário definido para o servidor será usado. Você pode especificar um dos IDs em <a href="http://php.net/manual/en/timezones.php" target="_ blank"> "Lista de fusos horários suportados" no Manual do PHP (clique para abrir uma nova janela com a página)</a>.)';
$lang['excludeMgAndSp']        = 'Não contar gerenciadores e superusuários? (consulte config "<a href="#config___manager">gerenciadores</a>" e "<a href="#config___superuser">superusuário</a>")';
$lang['exclusionList']         = 'IPs e hosts remotos que serão excluídos<br><br>O plugin não conta usuários com esses IPs e hosts remotos. Esta lista será útil se o seu site tiver muitos acessos por robôs a partir de IPs especificados e hosts remotos.<br>O plugin obtém hosts remotos por pesquisa inversa de IPs (gethostbyaddr).<br>Digite um IP ou host remoto por linha.<br>Caracteres curinga disponíveis:<br>? = um caractere (um caractere alfanumérico, um ponto "." ou um hífen "-")<br>* = um ou mais caracteres (caracteres alfanuméricos, pontos "." ou hífens "-") <br>! = um caractere (um número)<br>~ = um ou mais caracteres (números)<br><br>por exemplo: "123.456.???.123" -> 123.456.789.123 etc. (123.456.78.123 não será excluído)<br>por exemplo: "*.example.com" -> 123.456.789.123.example.com, 1-2-3-4.rooter.example.com, etc.';
$lang['reverseLookupFailed']   = 'Excluir do contador quando a pesquisa reversa (IPs para hosts remotos) falhar (IPs de robôs tendem a rejeitar a pesquisa inversa)';
$lang['reverseLookupException'] = 'IPs aos quais o plugin não aplicará a opção "reverseLookupFailed"<br><br>Digite um IP por linha.<br>Caracteres curinga disponíveis:<br>? = um caractere<br>* = um ou mais caracteres<br><br>por exemplo: "123.456.???.123" -> 123.456.789.123 etc. (123.456.78.123 não será excluído)<br>por exemplo: "123. *. 789.123" -> 123.456.789.123, 123.9.789.123, etc.';
$lang['reverseLookupCntrException'] = 'Países aos quais o plugin não aplicará a opção "reverseLookupFailed"<br><br>O plug-in obtém códigos de país por um serviço DNS de "cc.wariate.jp" (<a href="http://cc.wariate.jp/ " target="_ blank "> Detalhes em japonês</a>).<br>Digite os códigos de país com dois caracteres (ISO 3166-1 alpha-2) separados por vírgula.';
$lang['usrExclusion']          = 'Usuários ou grupos de usuários que serão excluídos<br><br>O plugin não conta esses usuários e usuários nesses grupos.<br>Insira usuários e grupos de usuários separados por vírgula.';
$lang['cntrExclusion']         = 'Países que serão excluídos<br><br>O plugin não contará os usuários desses países. Esta lista será útil se o seu site tiver muitos acessos por robôs dos países especificados.<br><br>O plugin obtém códigos de países por um serviço DNS de "cc.wariate.jp" (<a href="http : //cc.wariate.jp/" target="_ blank ">Detalhes em japonês</a>) <br> Digite os códigos de país com dois caracteres (ISO 3166-1 alpha-2) separados por vírgula.';
$lang['cntrInclusion']         = 'Países que serão contados<br><br>Se você especificar os países aqui, o plugin contará APENAS os usuários desses países. <br>O plugin obtém códigos de países por um serviço DNS "cc.wariate.jp" (<a href="http://cc.wariate.jp/" target="_ blank"> Detalhes em japonês</a>).<br>Digite os códigos de país de dois caracteres (ISO 3166-1 alpha-2) separados por vírgula.';
$lang['sfsExFreq']             = 'Verificar a frequência do endereço IP do visitante para não contar spammers? (É necessário o plugin Stopforumspam2)<br><br>Se o número fornecido for "0", o plugin não fará isso, caso contrário, fará. Você pode definir o limite especial para esta função. Se "-1", o plugin usará a confifuração "freqBorder" do plugin Stopforumspam2, se for maior que 0, o número será o limite.';
$lang['sfsExConf']             = 'Verificar a confiança do endereço IP do visitante para não contar spammers? (É necessário o plugin Stopforumspam2)<br><br>Se o número fornecido for "0", o plugin não fará isso, caso contrário, fará. Você pode definir o limite especial para esta função. Se "-1", o plug-in usará a configuração "trustBorder" do plugin Stopforumspam2, se for maior que 0 (e 100 ou menos), o número será o limite.';
$lang['saveLog']               = 'Salvar o registro de IPs, data e hora que os visitantes acessam este wiki?<br><br>O log será registrado para todas as páginas. Essa opção será útil quando você decidir quais IPs, hosts remotos e países excluir do contador.<br>Os arquivos de log serão salvos no diretório <code>accscounterlog</code> no diretório de cache (dentro do <a href="# config ___ savedir">diretório de dados</a> na configuração padrão). Pegue e exclua os arquivos de log, se necessário.';
$lang['excludeMgAndSp_o_0']    = 'Contar ambos';
$lang['excludeMgAndSp_o_sp']   = 'Não contar superusuário';
$lang['excludeMgAndSp_o_mg']   = 'Não contar gerenciadores (incluindo superusuários)';
$lang['saveLog_o_0']           = 'Não salvar';
$lang['saveLog_o_ppage']       = 'Salvar (Não criar arquivos para cada data)';
$lang['saveLog_o_pdate']       = 'Salvar (Vriar arquivos para cada data)';
