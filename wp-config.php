<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'challenge' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{$i(g6Yv[RWYC6;<oovP#P3?.BNlLp)L{.5S|o SE~8XQ{|/%s/e|=;~uNA*%A&$' );
define( 'SECURE_AUTH_KEY',  'EAS(hf,0*I.}KzJ:/nv9YX4i+t1p0*-Pk-w%]Dr97$R^mm9QK>[hh^,m17EEvZ-6' );
define( 'LOGGED_IN_KEY',    'y?7H]-]H|wusPR?t6>AA{!TDO6Cub*n~8x+`=ZB)Vn]b|Xy7QYjfz`>hD:Vry/qY' );
define( 'NONCE_KEY',        'qt*~|.,+3V:QKJm)ZiUhtN^!D]Md[tB}/R8+9<K([%,H|nUJQ].K=KPW07Gyb4)t' );
define( 'AUTH_SALT',        'A9Z(zw1~RqEQS2^ 3Ad::1&EKK;,kxS]j<$E,U>847aXyA:;CtcFg($Lutb,O)(J' );
define( 'SECURE_AUTH_SALT', 'D<NBz:hcd AayUPg@Z^m:_^u|l|u*T8RNOkRl]-w(LmU7$SI1vP!>g ee?H|mDh:' );
define( 'LOGGED_IN_SALT',   'cIMs*B|(Tek<Rq}w<5E?DY#I@<,tWaMEt7XA{YY9+t!bjo]JPh_aAusWFO{r^l:f' );
define( 'NONCE_SALT',       '/kJ`Rirh@JmC+I9cY;:gE3a1RKww3B8pGQyy^*-X[I$>1a O#)|tdvp*r;=v6fVV' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');