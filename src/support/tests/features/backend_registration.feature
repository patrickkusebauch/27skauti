Feature: Registration manipulation

  As a omnipotent admin of the website
  In order to have current contact information to group members
  I want to change the contact information of any user

  Background:
    Given the following "user" exists
      | id | username | password                                                     | active |
      | 1  | Luck     | $2y$10$4Op3A83MkfaaIDAge9uZ6.eNhoxyfvwwysRArnNO65Qb.iLRRpKcu | 1      |
    And the following "privilege" exists
      | user_id | base | registration | privilege | chronicle | vip    | news   | event  | guestbook | hlasinek |
      | 1       | člen | mazání       | mazání    | mazání    | mazání | mazání | mazání | mazání    | mazání   |
    Given I am on the Front Homepage
    When I fill in "username" with "Luck"
    And I fill in "password" with "dvacetsedm"
    And I press "Přihlásit"
    And I follow "Admin"

  @database @slow
  Scenario: New registration
    Given the following "member" exists
      | nickname  |
      | Klíšťák   |
    When I follow "Registrace"
    And I follow "Registrovat stávajícího člena"
    And I select "Klíšťák" from "nickname"
    And I fill in "birth_date" with "2000-11-11"
    And I press "Přidat/Změnit"
    Then I should see "Záznam byl úspěšně přidán"

  @database @slow
  Scenario: Edit registration
    Given the following "member" exists
      | nickname  |
      | Klíšťák   |
    And the following "registration" exists
      | member_nickname | birth_date  |
      | Klíšťák         | 2000-11-11  |
    When I follow "Registrace"
    When I follow "Edituj"
    And I press "Přidat/Změnit"
    Then I should see "Záznam byl úspěšně editován"

  @database @slow
  Scenario: Delete registration
    Given the following "member" exists
      | nickname  |
      | Klíšťák   |
    And the following "registration" exists
      | member_nickname | birth_date  |
      | Klíšťák         | 2000-11-11  |
    When I follow "Registrace"
    Then I should see "Klíšťák"
    When I follow "Smaž"
    Then I should not see "Klíšťák"
