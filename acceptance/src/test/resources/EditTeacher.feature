Feature: Edit Teacher
  Scenario: Successful modification
    Given The administrator is connected on a teacher modification page
    When The administrator change the name with "Roger"
    Then The new first name must be "Roger"

  Scenario: Modification error
    Given The administrator is connected on a teacher modification page
    When The administrator change the name with " "
    Then The first name shouldn't has changed because empty first name aren't allowed