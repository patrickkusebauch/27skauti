Feature: Organization overwiew

  In order to know who is in my group
  As a member of the group
  I want to see the structure and the members of the group

  Background: Location
    Given I am on the Front Homepage
    And I follow "Organizace"

  @database @slow
  Scenario Outline: Group structure
    Given the following "member" exists
      | nickname    | group   |
      | <nickname>  | <group> |
    And I follow "Organizace"
    Then I should see "Organizace oddílu"
    And I should see "<nickname>" in "#<set>"
  Examples:
    | nickname    | group               | set       |
    | Zip         | vedoucí oddílu      | Vedoucí   |
    | Kim         | zástupce vedoucího  | Vedoucí   |
    | Luck        | rover, webmaster    | Roveři    |
    | Kiwi        | oldskaut            | Oldskauti |
    | Marek       | mlok, rádce         | Mloci     |
    | Bizon       | tučňák              | Tučňáci   |
    | Blesk       | tučňák, nováček     | Tučňáci   |
    | Blesk       | tučňák, nováček     | Nováčci   |

  @database @slow
  Scenario Outline: Detail pages
    Given the following "member" exists
      | nickname    | group   |
      | <nickname>  | <group> |
    And I follow "<set>"
    Then I should see "<nickname>"
  Examples:
    | nickname    | group               | set       |
    | Zip         | vedoucí oddílu      | Vedení    |
    | Kim         | zástupce vedoucího  | Vedení    |
    | Luck        | rover, webmaster    | Roveři    |
    | Kiwi        | oldskaut            | Oldskauti |
    | Marek       | mlok, rádce         | Mloci     |
    | Bizon       | tučňák              | Tučňáci   |
    | Blesk       | tučňák, nováček     | Tučňáci   |
    | Blesk       | tučňák, nováček     | Nováčci   |

