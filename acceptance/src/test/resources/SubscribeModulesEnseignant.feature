# language: en
Feature: Ajouter des modules à un enseignant

  Scenario: Ajout des modules à un enseignant sans module
    Given l'administrateur est connectee
    When L'administrateur ajoute un module à l'enseignant
    And admin ajoute un autre module
    Then les modules ont ete ajouté


