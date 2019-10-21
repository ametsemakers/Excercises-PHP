<?php
define('HOTE', 'localhost');	// Mettre le nom d'hôte fourni par l'hébergeur
define('BDD', 'gestionprojet');	// Mettre le nom de la base de données fourni par l'hébergeur
define('UTIL', 'root');		// Mettre le nom de l'utilisateur de la base de données fourni par 
                    // l'hébergeur
define('MDP', '');			// Mettre le mot de passe

try
{
    // Connexion à la base de données en UTF8
    @$pdo = new PDO('mysql:host=' . HOTE . ';dbname=' . BDD . ';charset=UTF8', UTIL,MDP);

}
catch (PDOException $e)
{
    echo 'La connexion a échouée : ' . utf8_encode($e->getMessage());
    exit(1);
}