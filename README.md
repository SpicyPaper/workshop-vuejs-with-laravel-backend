# Introduction
Ce document est là pour vous aider à configurer étape par étape la seconde partie du workshop sur VueJS avec Laravel.
Merci de suivre toutes les étapes attentivement et de venir vers moi en cas de problème.

# Prérequis
Installer les prérequis demandés dans l'email de Steve :
- XAMPP à jour : https://www.apachefriends.org/fr/index.html
    - Avec PHP 7.3 activé au minimum
	- Avec MySQL (>5.6) ou MariaDB équivalent
- Composer : https://getcomposer.org/doc/00-intro.md#installation-windows
- Laravel : https://laravel.com/docs/8.x/installation#installing-laravel

> **Attention** : La suite de l'installation se fait avec les prérequis au-dessus, vous pouvez utiliser d'autres outils si vous le souhaitez, mais assurez-vous de pouvoir configurer la suite !

# Installation

0. Vérifiez que XAMPP et Composer soient bien installés sur votre machine (redémarrez vos shells et vos IDE après l'installation)

1. Allez dans le dossier `C:\xampp\htdocs` ouvrez un bash et clonez le projet https://github.com/SpicyPaper/workshop-vuejs-with-laravel-backend
	- !!! Assurez-vous d'avoir la dernière version du projet !!!
	- **Et ne copiez collez pas un .zip, clonez le projet (vraiment ! demandez moi, je peux vous aider si vous n'y arrivez pas)**

2. Une fois le projet cloné, aller dans `C:\Windows\System32\drivers\etc`, ouvrez le fichier `hosts` et ajoutez-y une ligne supplémentaire (vous aurez besoin des accès admin)
```
127.0.0.1  workshop-vuejs.test
```

3. Allez ensuite ici `C:\xampp\apache\conf\extra`, ouvrez le fichier `httpd-vhosts.conf` et ajoutez-y une ligne également
> Si les noms sont les mêmes vous pouvez copier coller, mais si le nom de votre repo est différent, vous devrez peut être modifier le chemin après "DocumentRoot" ou modifier l'url après "VirtualHost"
```
<VirtualHost workshop-vuejs.test:80>
    DocumentRoot "C:/xampp/htdocs/workshop-vuejs-with-laravel-backend/public"
</VirtualHost>
```
> Si vous voulez plus d'info sur ces manipulations : https://divpusher.com/blog/how-to-run-laravel-on-windows-with-xampp/

4. Installez les dépendances de composer depuis le dossier du projet
```
composer install
```

5. Créer un fichier .env à partir de .env.example dans le dossier du projet
```
cp .env.example .env
```

6. Générer une clé d'encryption
```
php artisan key:generate
```

7. Copier ces variable dans votre .env
```
APP_URL=http://workshop-vuejs.test
...
DB_DATABASE=workshop_vuejs
...
PASSPORT_LOGIN_ENDPOINT="http://workshop-vuejs.test/oauth/token"
```

8. Redémarrez XAMPP, puis démarrez MySQL et Apache sur XAMPP

9. Une fois les 2 services de XAMPP démarrés, cliquez sur "Admin" du service MySQL et créez une nouvelle base de données vierge et nommez-la "workshop_vuejs" pour correspondre au fichier .env
 
10. Exécutez les migrations Laravel
```
php artisan migrate
```

11. Configurer Passport (private key pour l'authentification)
```
php artisan passport:install
```

12. La précédente commande vous affiche des clés utiles pour l'authentification par Token avec Passport (https://laravel.com/docs/8.x/passport)

Copiez la valeur de la clé "Client secret" du deuxième client, puis collez là dans le .env après PASSPORT_CLIENT_SECRET= :
```
PASSPORT_CLIENT_SECRET=(valeur de la clé)
```
Tout en précisant l'ID du client à 2 :
```
PASSPORT_CLIENT_ID=2
```

13. Redémarrez encore une fois les 2 services de XAMPP (MySQL et Apache) et vous devriez être bon :)

14. Pour testez que l'API répondent correctement et que vous avez correctement tout configuré, veuillez tester cet URL, en remplaçant "client_secret" avec la "Client Secret" que vous avez mit dans votre .env :
http://workshop-vuejs.test/api/test/client_secret

Si la réponse de cet URL est positif, vous avez correctement configuré le BackEnd et vous êtes prêt à suivre la suite du workshop, sinon contactez moi !

Merci.
@SpicyPaper
