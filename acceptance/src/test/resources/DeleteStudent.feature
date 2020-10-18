# language: en
Feature: Supprimer un étudiant

  Scenario: Etudiant supprimé avec succès
    Given l' administrateur est connecté
    When l'administrateur valide la suppression de l'étudiant
    Then l'étudiant est supprimé de la liste des étudiants