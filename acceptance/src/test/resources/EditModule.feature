Feature: Edit Module
  Scenario: Successful modification
    Given The administrator is connected on a module modification page
    When The administrator change the module name with "Mon super cours"
    Then The new module name must be "Mon super cours"

  Scenario: Modification error
    Given The administrator is connected on a module modification page
    When The administrator change the module name with " "
    Then The module shouldn't has changed because empty module names aren't allowed