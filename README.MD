# Fonctionnalités
  - Tableau des scores globaux
  - Détail du score de chaque joueur
  - Détail des actions sur chaque serveur
  - Admin : enregistrement des flags des joueurs
  - Admin : mise en/hors ligne des machine des joeuurs
  - Admin : enregistrement d'événements spéciaux (1er en ligne, reset de la machine, ...)
  - Soumission d'un flag trouvé
  - Enregistrement de toutes les soumissions avec un état ok / échec

# Configuration
  - Editer le fichier config/config.php
  - Importer la BDD (les evenements saisis ont eu lieu)
  - That's all folks !

# Ajout de type d'actions
  - Si c'est un flag : saisieUser = 1, saisieAdmin = 0 __ET__ créer une autre action ```P&eacute;nalit&eacute; - ``` + libellé flag en mode saisieUser = 0, saisieAdmin = 0
  - Si c'est un bonus / malus : champ saisieUser = 0, saisieAdmin = 1

# Choisir si un événément doit s'affcher sur la page de la machine
  - typeaction -> isEvtMAchine = 1 si oui, 0 sinon

# BDD
  - typeaction : tous les types d'actions possibles dans le jeu
  - groupe : liste des groupes en jeu
  - flags : liste des flags en jeu
  - evenement : occurence d'un événement (regroupant un typeAction, un groupe)
