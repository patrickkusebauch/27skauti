Feature: Profile & User changes

  As a user of the website
  In order to keep my information up to date
  I want to change my credentials

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
  Scenario: Change password
    When I follow "Profil"
    And I fill in "oldpassword" with "dvacetsedm"
    And I fill in "password" with "noveheslo"
    And I fill in "passwordVerify" with "noveheslo"
    And I press "Změnit"
    Then I should see "Heslo bylo změněno"