Feature: Edit Student
  Scenario: Successful modification
    Given The administrator is connected on a student modification page
    When The administrator change the name with "Jean"
    Then The new first name must be "Jean"

  Scenario: Modification error
    Given The administrator is connected on a student modification page
    When The administrator change the name with " "
    Then The first name shouldn't has changed because empty first name aren't allowed