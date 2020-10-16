Feature: Login redirection

  Scenario: Administrator redirection
    Given User is on the login page
    When The user connect as an administrator
    Then The user is redirected to the administration page

  Scenario: Administrative staff
    Given User is on the login page
    When The user connect as an administrative staff
    Then The user is redirected to the alert page

  Scenario: Teacher
    Given User is on the login page
    When The user connect as a teacher
    Then The user is redirected to the module list page