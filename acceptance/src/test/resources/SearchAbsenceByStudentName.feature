Feature: SearchAbsenceByName

Scenario:An user search student absence by his name
  Given A teacher is connected and go to the absence page
  When The user enter a student name in the absence search bar
  Then The name of the student appear in the absence search result