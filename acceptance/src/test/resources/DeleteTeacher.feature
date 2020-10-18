# language: en
Feature: Supprimer un enseignant

  Scenario: Enseignant supprimé avec succès
    Given l'administrateur est  connecté
    When l'administrateur valide la suppression de l'enseignant
    Then l'enseignant est supprimé de la liste des enseignants