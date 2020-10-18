# language: en
Feature: L'enseignant peut modifier une absence

  Scenario : Modification de l'absence d'un étudiant
    Given L’utilisateur est un enseignant
    When L’enseignant modifie l’absence d'un etudiant
    Then L’absence a été modifie

