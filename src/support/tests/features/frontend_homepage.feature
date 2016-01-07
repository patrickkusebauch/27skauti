Feature: Parent signup

  In order to register my son
  As a parent
  I want to be able to make an informed decision about signup

  Background: My location
    Given I am on the Front Homepage

  @local @fast
  Scenario: General info
    When I follow "Nábor"
    Then I should see "Informace o našem oddíle"

  @database @slow
  Scenario Outline: Cover letter
    Given the following "member" exists
      | nickname    | name    | surname   | group   | entered   |
      | <nickname>  | <name>  | <surname> | <group> | <entered> |
    When I follow "Pro Rodiče"
    Then I should see "vedoucí oddílu"
    Then I should see "Vedení oddílu"
  Examples:
    | nickname    | name    | surname   | group                     | entered    |
    | Zip         | Ondřej  | Petrovský | vedoucí oddílu            | 2010-06-06 |
    | Luck        | Patrick | Kusebauch | webmaster, vedoucí oddílu | 2010-06-06 |

  @local @glacial @javascript
  Scenario: Lounge
    When I follow "Klubovna"
    Then I should see "Kde nás najdete?"
    And I should see "Fotografie naší klubovny"
    When I click on a photo
    Then I should see the photo in a new window

  @database @slow
  Scenario Outline: Contacts
    Given the following "member" exists
      | nickname    | name    | surname   | group               | entered    |
      | <nickname>  | <name>  | <surname> | <group>             | <entered>  |
      | Kim         | Jirí    | Mareš     | zástupce vedoucího  | 2001-09-11 |
    When I follow "Kontakty"
    Then I should see "vedoucí oddílu"
    Then I should see "zástupce vedoucího"
  Examples:
    | nickname    | name    | surname   | group                     | entered    |
    | Zip         | Ondřej  | Petrovský | vedoucí oddílu            | 2010-06-06 |
    | Luck        | Patrick | Kusebauch | webmaster, vedoucí oddílu | 2010-06-06 |

  @local @slow @mail
  Scenario Outline: Non-binding signup
    When I follow "Přidej se"
    Then I should see "Nezávazná přihláška"
    When I fill in "name" with "<name>"
    And I fill in "mail" with "<mail>"
    And I fill in "phone" with "<phone>"
    And I press "Nezávazně se přihlásit"
    Then I should see "Přihláška byla odeslána"
  Examples:
    | name              | mail                | phone             |
    | Patrick           | root@localhost.net  | 123123123         |