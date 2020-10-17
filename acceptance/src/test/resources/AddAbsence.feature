# language: en

Feature: L'enseignant peut ajouter une absence.L’enseignant peut ajouter une absence avec le nom du module, l’étudiant concerné, la date et heure du cours et un commentaire

  Scenario: Ajouter une absence
  Given L’utilisateur est un enseignant
  When L’utilisateur enregistre une absence pour un étudiant dans le module test pas vraiment fonctionnelle le 2020/10/17 à 12:34
  Then L’absence a été ajouté

