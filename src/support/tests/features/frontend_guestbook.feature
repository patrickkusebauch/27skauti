Feature: Posting opinions on the website

  As a visitor
  In order to let others know I was there
  I want to post into the guestbook

  Background:
    Given I am on the Front Homepage
    And I follow "Kniha Návštěv"

  @database @slow
  Scenario Outline: Not signed-in user
    When I fill in the following:
      | name  | <name>  |
      | mail  | <mail>  |
      | post  | <post>  |
      | web   | <web>   |
    And I press "Odeslat"
    Then I should see "Zpráva byla odeslána"
    And I should see "<name>"
    And I should see "<mail>"
    And I should see "<post>"
    And I should see "<web>"
    Examples:
    | name  | mail                    | post        | web         |
    | Luck  | pata.kusik111@senzam.cz | Nějaký text | 27skauti.cz |
    | Luck  |                         | Nějaký text | 27skauti.cz |
    | Luck  | pata.kusik111@senzam.cz | Nějaký text |             |
    | Luck  |                         | Nějaký text |             |

  @local @slow
  Scenario Outline: Archive
    When I fill in the following:
      | name  | <name>  |
      | mail  | <mail>  |
      | post  | <post>  |
      | web   | <web>   |
    And I press "Odeslat"
    When I follow "Archiv"
    Then I should see "<name>"
    And I should see "<mail>"
    And I should see "<post>"
    And I should see "<web>"
    Examples:
    | name  | mail                    | post        | web         |
    | Luck  | pata.kusik111@senzam.cz | Nějaký text | 27skauti.cz |
    | Luck  |                         | Nějaký text | 27skauti.cz |
    | Luck  | pata.kusik111@senzam.cz | Nějaký text |             |
    | Luck  |                         | Nějaký text |             |





