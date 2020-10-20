# language: en
Feature: Ajouter des étudiants à un module

  Scenario: Ajout effectué avec succès
    Given l'administrateur est maintenant connecté
    And le module d'enseignement impacté existe
    And l'étudiant à ajouter existe
    When l'administrateur tente d'ajouter un étudiant au module d'enseignement
    Then l'étudiant est ajouté au module avec succès