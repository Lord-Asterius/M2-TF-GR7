Feature: Login

  Scenario: Se connecter fonctionne
    Given L'utilisateur n’est pas connecté
    When L'utilisateur se connecte avec une paire identifiant/mdp valide
    Then L'utilisateur est connecté