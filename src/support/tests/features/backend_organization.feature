Feature: Group organization manipulation

  As a omnipotent admin of the website
  In order to keep everybody inform about who is the member
  I want to change the organizational structure of the group

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
  Scenario: Create new member
    When I follow "Organizace"
    And I follow "Přidat nového člena"
    And I select "Luck" from "user_id"
    And I fill in "nickname" with "Luck"
    And I fill in "title" with "BSci."
    And I fill in "name" with "Jméno"
    And I fill in "surname" with "Přijmení"
    And I fill in "group" with "Rover"
    And I select "Rover" from "stripe"
    And I fill in "entered" with "9999-12-31"
    And I press "Přidat/Upravit"
    Then I should see "Záznam byl úspěšně vytvořen"

  @database @slow
  Scenario: Member editation
    Given the following "member" exists
      | name  | surname | entered     | nickname  |
      | Jiří  | Mareš   | 1995-05-17  | Kim       |
    When I follow "Organizace"
    And I follow "Edituj"
    And I press "Přidat/Upravit"
    Then I should see "Záznam byl úspěšně aktualizován"

  @database @slow
  Scenario: Member deletion
    Given the following "member" exists
      | name  | surname | entered     | nickname  |
      | Jiří  | Mareš   | 1995-05-17  | Kim       |
    When I follow "Organizace"
    Then I should see "Jiří"
    When I follow "Smaž"
    Then I should not see "Jiří"