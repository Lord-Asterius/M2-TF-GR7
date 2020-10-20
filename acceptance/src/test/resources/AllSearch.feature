Feature: AllSearch

Scenario:
  Given The teacher is on the student list page
  When The user enter a student name in the student search bar
  Then The student appear in the student search result

Scenario:
  Given The administative staff is on the student list page
  When The user enter a student name in the student search bar
  Then The student appear in the student search result

Scenario:
  Given The administrator is on the student list page
  When The user enter a student name in the student search bar
  Then The student appear in the student search result

Scenario:
  Given The administative staff is on the teacher list page
  When The user enter a teacher name in the teacher search bar
  Then The teacher appear in the teacher search result

Scenario:
  Given The administrator is on the teacher list page
  When The user enter a teacher name in the teacher search bar
  Then The teacher appear in the teacher search result

Scenario:
  Given The administrator is on the module list page
  When The user enter a module name in the module search bar
  Then The module appear in the module search result

