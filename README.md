# Chartres-ToBook

Projet de fin d'étude Wild Code School 1ère promo Chartres (durée 2 mois)

Etudiant : Thomas Javanaud - Omar Kennouche - Tony Palaquer - Dorian Walck

1 Portage d'un projet php procédural vers le framework symfony 2.8

2 Développement de nouvelles fonctionnalités (emailing, autocompletion recherche adresse, notation)


## Installation

    git clone https://github.com/WildCodeSchool/Chartres-ToBook.git tobook
    cd tobook
    ./chmod.sh
    composer install

Importer la base de données depuis _db/flo_latest_db.sql
Puis lancer le script de mise à jour du schéma :

    php app/console doctrine:schema:update --force
    
