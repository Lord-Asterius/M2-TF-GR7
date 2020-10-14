Feature: Edit Student
  Scenario: Successful modification
    Given The administrator is connected
    And The administrator is on a student modification page
    When The administrator change the name with "Dupond"
    Then The new student name must be "Dupond"

  Scenario: Modification error
    Given The administrator is connected
    And The administrator is on a student modification page
    When The administrator change the name with " "
    Then The student first name shouldn't has changed because empty first name aren't allowed