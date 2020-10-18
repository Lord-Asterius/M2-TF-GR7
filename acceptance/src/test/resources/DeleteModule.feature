# language: en
Feature: Supprimer un module d'enseignement

  Scenario: Suppression effectuée avec succès
    Given l'administrateur  est connecté
    When l'administrateur tente de supprimer le module d'enseignement
    Then le module est supprimé avec succès