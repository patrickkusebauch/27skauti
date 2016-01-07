Feature: Guestbook manipulation

  As a omnipotent admin of the website
  In order to regulate faul language on the site
  I want to manipulate guestbook posts

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
  Scenario: Show/Unshow guestbook post
    Given the following "guestbook" exists
      | name  | mail                    | post        | web         | show | time                 |
      | Luck  | pata.kusik111@senzam.cz | Nějaký text | 27skauti.cz | 1    | 9999-12-31 23:59:59  |
    When I follow "Kniha Návštěv"
    Then I should see "Odzobraz"
    When I follow "Odzobraz"
    Then I should see "Zobraz"
    When I follow "Zobraz"
    Then I should see "Odzobraz"

  @database @slow
  Scenario: Delete guestbook post
    Given the following "guestbook" exists
      | name  | mail                    | post        | web         | show | time                 |
      | Luck  | pata.kusik111@senzam.cz | Nějaký text | 27skauti.cz | 1    | 9999-12-31 23:59:59  |
    When I follow "Kniha Návštěv"
    And I follow "Smaž"
    Then I should see "Zpráva byla smazána"

  @database @slow
  Scenario: Edit guestbook post
    Given the following "guestbook" exists
      | name  | mail                    | post        | web         | show | time                 |
      | Luck  | pata.kusik111@senzam.cz | Nějaký text | 27skauti.cz | 1    | 9999-12-31 23:59:59  |
    When I follow "Kniha Návštěv"
    And I follow "Edituj"
    And I press "Změnit"
    Then I should see "Přísměvek byl úspěšně editován"
