Feature: Créer un module d'enseignement

  Scenario: Module créé avec succès
    Given l'administrateur s'est connecté
    And l'administrateur a renseigné le nom du module à créer
    When l'administrateur tente de créer le module
    Then le nouveau module est ajouté à la liste des modules d'enseignement existants

  Scenario: Erreur lors de la création du module
    Given l'administrateur s'est connecté
    When l'administrateur tente de créer le module avec un nom vide
    Then la création doit échouer