<?php
//The entry below were created by iThemes Security to disable the file editor
define( 'DISALLOW_FILE_EDIT', true );

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'accaia');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'vertrigo');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DpAzgU^ARfTT,J?ks/sHm0S2H7>e;~.i:SH+*o7l&L<5uM~;A*[={xr}UeBf{:<h');
define('SECURE_AUTH_KEY',  'U}oCNB:P9%v*+`HjK%R/_ok7I{v>,4_@USIHGhO:Qa,yTPdlQh?%_E8jJ_5<cGA-');
define('LOGGED_IN_KEY',    '37jIO%oh`+Zd^!`Ms+_lW^:Vqa`TT!t2{ %wzArOI-EM1 wU(qivXJ_MPf-r;=vB');
define('NONCE_KEY',        'Pc}%n-{<@T)$xhN1ZCW!+=5m{^s4^ZqrYFSz:Bbb{sr?F?bq0  1c|`<;U%GJLL#');
define('AUTH_SALT',        'Pt6l{x xXD`ud{8FNLEJMs]TXx/K2P@JRnA IXHSKe{8I^bIv,kJXy~Y(uV!&lc~');
define('SECURE_AUTH_SALT', 'YC -.^uLc>.7V4Q~D>yb9Q^fdYHAAt ty<=];vh7Y>jIUsf>{~F.3o6!>zlG7Q4|');
define('LOGGED_IN_SALT',   '3x8@d}=sC2;%XG?E0DZ%Px3b{^;-7TG2j)E0z~eV@:Y|aq_&h@YeF&;B|f/-z*k/');
define('NONCE_SALT',       '[TG|_S `S4J`0AL!%r`1aH_8[qg<S} 7iM-rk@ *P?9.gF& X J?g{F%KBQMJF#u');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wpaccaia_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');