<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Schopf <pschopf@gmail.com>
 */
$lang['err1']                  = 'Erro no plugin Accscounter: Não é possível abrir o diretório do log deste arquivo;';
$lang['err2']                  = 'Erro no plugin Accscounter: Defina um argumento válido (hoje, ontem ou total).';
$lang['err3']                  = 'Erro no plugin Accscounter: Defina um argumento válido (hoje, ontem ou período total).';
$lang['err4']                  = 'Erro no plugin Accscounter: Diretório não encontrado ou não pôde ser lido;';
$lang['noitems']               = 'Não há itens a serem mostrados.';
$lang['datanotice']            = '[Plugin Accscounter] O destino de salvamento dos dados deste plugin foi alterado. Os dados antigos ainda não foram movidos para o novo destino. <a href="?do=accscounter_datatransfer">Clique aqui para mover ou excluir os dados.</a>';
$lang['datanotice2']           = '[Plugin Accscounter] O destino de salvamento dos dados deste plugin foi alterado <b>NOVAMENTE</b>. Os dados antigos ainda não foram movidos para o novo destino. Lamento incomodá-lo, mas <a href="?do=accscounter_datatransfer">clique aqui para mover ou excluir os dados.</a>';
$lang['moveiplog']             = 'Mover dados de log de endereços IP';
$lang['success']               = 'finalizado';
$lang['failiplog']             = 'erro (Confirme a permissão para acessar <code>/lib/plugins/accscounter/log/iplogs/</code>. Se você não entender isso, mova ou exclua o diretório com ferramentas como um aplicativo de FTP.)';
$lang['movenmlog']             = 'Mover dados de log do número de acessos';
$lang['failnmdir']             = 'erro ao ler o diretório (Confirme a permissão para acessar <code>/lib/plugins/accscounter/log/</code>. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['failnmload']            = 'erro ao ler o arquivo (Confirme a permissão para acessar arquivos dentro de <code>/lib/plugins/accscounter/log/</code>. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['failnmsave']            = 'leitura bem-sucedida, mas erro na gravação (Confirme a permissão para acessar o diretório onde metarquivos são salvos. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['failnmdel']             = 'leitura e escrita bem-sucedidas, mas erro na exclusão (Confirme a permissão para acessar arquivos dentro de <code>/lib/plugins/accscounter/log/</code>. Se você não entender isso, exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['failnmload2']           = 'erro ao ler arquivo (Confirme a permissão para acessar arquivos no diretório onde metarquivos são salvos. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['failnmdel2']            = 'leitura e gravação bem-sucedidas, mas erro na exclusão (Confirme a permissão para acessar arquivos no diretório onde metarquivos são salvos. Se você não entender isso, exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['complete']              = 'Movimentação de arquivos concluída. O diretório do destino antigo foi excluído.';
$lang['remaining']             = 'Erro ao excluir o diretório do destino anterior, <code>/lib/plugins/accscounter/log/</code>. Verifique se sobrou algum arquivo lá. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['allloaded']             = 'O plugin tentou carregar e mover todos os arquivos de log existentes.';
$lang['nothing']               = 'Não há nenhum arquivo de log a ser movido. Talvez não seja necessário fazer isso.';
$lang['funcend']               = 'As funções foram todas concluídas.';
$lang['successdel']            = 'Diretório excluído <code>/lib/plugins/accscounter/log/</code>.';
$lang['faildel']               = 'Erro ao excluir o diretório <code>/lib/plugins/accscounter/log/</code>. Verifique se sobrou algum arquivo lá. Se você não entender isso, mova ou exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['successdellog']         = 'excluído';
$lang['faildellog']            = 'erro na exclusão (Confirme a permissão para acessar arquivos no diretório onde metarquivos são salvos. Se você não entender isso, exclua os arquivos com ferramentas como um aplicativo de FTP.)';
$lang['alldeleted']            = 'O plugin tentou excluir todos os arquivos de log antigos.';
$lang['nothingtodelete']       = 'Não há arquivos de log a excluir. Talvez não seja necessário fazer isso.';
$lang['menu']                  = 'Access Counter - Gerenciador de Dados';
$lang['selectall']             = 'Marcar tudo';
$lang['pagename']              = 'nome da página';
$lang['sofar']                 = 'PVs até agora';
$lang['lastdate']              = 'Último acesso em';
$lang['today']                 = 'PVs de hoje';
$lang['yest']                  = 'PVs de ontem';
$lang['ipadd']                 = 'IP do último visitante';
$lang['pleasechoose']          = '**ESCOLHA**';
$lang['sfscheck']              = 'Verificar Spammer';
$lang['delete']                = 'Excluir o Log';
$lang['run']                   = 'Executar';
$lang['sfstried']              = 'A página %s foi acessada por um spammer (endereço IP: %s) por %d vezes; portanto, o sistema deduziu o número de acessos do remetente de spam dos PVs até agora e dos de hoje. Por favor, confirme.';
$lang['sfsfinish']             = 'Terminou a verificação de spammer.';
$lang['mngfaileddel']          = 'Erro ao excluir o arquivo de log da página %s. Confirme a permissão para acessar arquivos dentro do diretório em que o sistema salva os metarquivos. Se você não entender isso, exclua os arquivos com ferramentas como uma ferramenta de FTP.';
$lang['mngdelfinish']          = 'Exclusão do log concluída.';
