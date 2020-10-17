Feature: Ajouter un enseignant

  Scenario: Ajout d'un enseignant effectué avec succès
    Given l'administrateur est connecté
    And l'administrateur a renseigné les champs prénom, nom, mot de pass et date de naissance
    When l'administrateur tente d'ajouter le nouvel enseignant
    Then le nouvel enseignant est ajouté avec succès à la liste des étudiants

  Scenario: Erreur lors de l'ajout d'un enseignant
    Given l'administrateur est connecté
    And l'administrateur a renseigné les champs prénom, nom, mot de pass éronné et date de naissance
    When l'administrateur tente d'ajouter le nouvel enseignant
    Then l'ajout doit échouer
