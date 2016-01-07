Feature: History manipulation

  As a omnipotent admin of the website
  In order to know the history of the group
  I want to change the history entries

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
  Scenario: History creation
    When I follow "Historie oddílu"
    And I follow "Přidat historii oddílu"
    And I fill in "year" with "2010-2011"
    And I fill in "game" with "Táborovka"
    And I fill in "leaders" with "Zip"
    And I fill in "deputies" with "Kim"
    And I fill in "oldscouts" with "Krab"
    And I fill in "rangers" with "Opic"
    And I fill in "club" with "Hanychov"
    And I fill in "camp" with "Vápno"
    And I fill in "mloci" with ""
    And I fill in "tucnaci" with ""
    And I fill in "jezevci" with ""
    And I press "Přidat/Změnit"
    Then I should see "Historie oddílu pro rok 2010-2011 byla přidána"

  @database @slow
  Scenario: History editation
    Given the following "history" exists
      | year       | game  | leaders | deputies  | oldscouts | rangers   | club      | camp    | mloci     | tucnaci | jezevci |
      | 2010-2011  | ???   | Zip     | Kim, Krab | Kiwi, Jim | Šíp, Opic | Hanychov  | Zábrtka | Orel, Bee | Fretka  |         |
    When I follow "Historie oddílu"
    And I follow "Edituj"
    And I press "Přidat/Změnit"
    Then I should see "Historie oddílu pro rok 2010-2011 byla změněna"

  @database @slow
  Scenario: History deletion
    Given the following "history" exists
      | year       | game  | leaders | deputies  | oldscouts | rangers   | club      | camp    | mloci     | tucnaci | jezevci |
      | 2010-2011  | ???   | Zip     | Kim, Krab | Kiwi, Jim | Šíp, Opic | Hanychov  | Zábrtka | Orel, Bee | Fretka  |         |
    When I follow "Historie oddílu"
    Then I should see "2010-2011"
    When I follow "Smaž"
    Then I should see "Zápis historie z roku 2010-2011 byl úspěšně vymazán"
