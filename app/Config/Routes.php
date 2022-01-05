<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::view/Accueil');
$routes->get('/gererprofil', 'Pages::view/gererprofil');
$routes->get('/Connexion', 'Pages::view/Connexion');
$routes->get('/Inscription', 'Pages::view/Inscription');
$routes->get('/Ajouter', 'Pages::view/Ajouter');
$routes->get('/Annonce', 'Pages::view/Annonce');
$routes->get('/Update', 'Pages::view/Update');
$routes->get('/Message', 'Pages::view/Message');
$routes->get('/Admin', 'Pages::view/Admin');
$routes->get('/Offres', 'Pages::view/Offres');
$routes->get('/Conversation', 'Pages::view/Conversation');
$routes->get('/annonceutilisateur', 'Pages::view/annonceutilisateur');
$routes->get('/AdminComptes', 'Pages::view/AdminComptes');
$routes->get('/messageadmin', 'Pages::view/messageadmin');
$routes->get('/disconnect', 'cUtilisateur::disconnect');
$routes->get('/Annonce/louer', 'cAnnonces::changer_etat');
$routes->get('/Modifier', 'Pages::view/ModifierAnnonces');
$routes->get('/recupmdp', 'Pages::view/recupmdp');
$routes->get('/mdpoublie', 'Pages::view/mdpoublie');
$routes->get('/SupprimerCompte', 'cUtilisateur::delete_utilisateur');
//$routes->match(['get'], 'SupprimerCompte', 'cUtilisateur::envoi_mail');
$routes->match(['get', 'post'], 'Inscription', 'cUtilisateur::create_utilisateur');
$routes->match(['get', 'post'], 'Connexion', 'cUtilisateur::display_utilisateur');
$routes->match(['get', 'post'], 'Ajouter', 'cAnnonces::create_annonce');
$routes->match(['get', 'post'], 'Update', 'cUtilisateur::update_utilisateur');
$routes->match(['get', 'post'], 'gererprofil', 'cUtilisateur::update_utilisateur');
$routes->match(['get'], 'gererprofil', 'cUtilisateur::envoi_mail');
//$routes->match(['get'], 'Offres', 'cAnnonces::paginer');
$routes->match(['get', 'post'], 'messageadmin', 'cUtilisateur::envoi_mail');
$routes->match(['get', 'post'], 'Message', 'cUtilisateur::envoi_mail');
$routes->match(['get'], 'MailSupression', 'cUtilisateur::envoi_mail');
$routes->match(['get'], 'EnvoiMail', 'cUtilisateur::envoi_mail');
$routes->match(['get'], 'ModifierAnnonces', 'Pages::view/ModifierAnnonces');
$routes->match(['get'], 'bloquer', 'cUtilisateur::bloquer_publication');
$routes->match(['get'], 'AdminComptes/envoimail', 'cUtilisateur::envoi_mail');
$routes->match(['get'], 'SupprimerMessages', 'cMessages::delete_all');
$routes->match(['get'], 'SupprimerPhotos', 'cAnnonces::delete_all_photos');
$routes->match(['get'], 'SupprimerComptes', 'cUtilisateur::delete_utilisateur');
$routes->match(['get', 'post'], 'Supprimer', 'cAnnonces::delete_annonce');
$routes->match(['post'], 'ModifierAnnonces', 'cAnnonces::update_annonce');
$routes->match(['post'], 'Modifier', 'cAnnonces::update_annonce');
$routes->match(['post'], 'Annonce', 'cMessages::send_message');
$routes->match(['get','post'], '/mdpoublie', 'cUtilisateur::envoi_mail');
$routes->match(['get'], 'Conversation/lu', 'cMessages::set_lu');
$routes->match(['post'], 'Conversation', 'cMessages::send_message');
$routes->match(['post'], 'recupmdp', 'cUtilisateur::recup_mdp');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
