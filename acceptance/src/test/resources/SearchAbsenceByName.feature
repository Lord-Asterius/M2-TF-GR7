Feature: SearchAbsenceByName

Scenario:An user search students absence by module name
  Given A user is connected and go to the absence page
  When The user enter a module name in the absence search bar
  Then The name of the module appear in the search result