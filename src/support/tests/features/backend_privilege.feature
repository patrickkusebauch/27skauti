Feature: Privileges

  As an omnipotent admin of the website
  In order to make more omnipotent creatures
  I want to change access privileges of other users

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

  @database @glacial @javascript
  Scenario: Change privileges
    Given the following "user" exists
      | id | username | password                                                     | active |
      | 2  | Krab     | $2y$10$4Op3A83MkfaaIDAge9uZ6.eNhoxyfvwwysRArnNO65Qb.iLRRpKcu | 1      |
    And the following "privilege" exists
      | user_id | base |
      | 2       | člen |
    When I follow "Práva"
    And I select "Krab" from "user_id"
    And I select "Mazání" from "news"
    And I press "Změnit práva"
    Then I should see "Přístupová práva byla úspěšně změněna"
