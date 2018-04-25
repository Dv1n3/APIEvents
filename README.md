***Clonez le repository dans votre wamp/www***
git clone https://github.com/Dv1n3/APIEvents.git

***Téléchargez les dépendances en éxécutant dans la console:***
composer update

***Télechargez et installez Postman à partir du lien suivant:***
https://www.getpostman.com/apps

***Création de la base de données*** 

**php bin/console doctrine:database:create **
**php bin/console doctrine:schema:update --force**

****Dans Postman****

***Créer un évenement POST http://localhost/APIEvents/web/app_dev.php/api/events***
*La date de création de l"évenement est créée automatique dans le constructeur de l'objet avec un Datetime()*

{
        "name": "name 1",
        "referrer": "referrer 1",
        "cookieId": 1
}

***Afficher tous les évenements GET http://localhost/APIEvents/web/app_dev.php/api/events***

***Afficher un groupe GET http://localhost/APIEvents/web/app_dev.php/api/events/1***

***Modifier partiellement un groupe PATCH http://localhost/APIEvents/web/app_dev.php/api/events/1***

{ 
"name": "modifiedName"
}

***Modifier totalement un groupe POST
http://localhost/APIEvents/web/app_dev.php/api/events/1***

{
     "name":"modifiedName,
     "referrer":"modifiedreferrer",
     "cookieId":1
}


***Supprimer un évenement DELETE http://localhost/APIEvents/web/app_dev.php/api/events/1***


***Afficher les statistiques de tous les évenements***
http://localhost/APIEvents/web/app_dev.php/api/dashboard/byCreationDate

***Afficher les évenements par date de création***
http://localhost/APIEvents/web/app_dev.php/api/dashboard/byCreationDate
