Feature: News

  As a member of the group
  In order to be properly informed about what is happening
  I want to see news posted by the group leaders

  @database @slow
  Scenario: News on the homepage
    Given the following "news" exists
    | type    | posted      | heading | show  |
    | Zpráva  | 2010-10-10  | Novinka | 1     |
    | Zpráva  | 2011-01-04  | první   | 1     |
    | Zpráva  | 2011-01-03  | druhá   | 1     |
    | Zpráva  | 2011-01-02  | třetí   | 1     |
    | Zpráva  | 2011-01-01  | čtvrtá  | 1     |
    And I am on the Front Homepage
    Then I should not see "Novinka"
    And I should see "první" before "druhá"
    And I should see "druhá" before "třetí"
    And I should see "třetí" before "čtvrtá"
    When I follow "první"
    Then I should be on "aktuality/aktuality"

    @database @slow
  Scenario: News in the news page
    Given the following "news" exists
      | type    | posted      | heading   | content | show  |
      | Zpráva  | 2010-10-10  | Novinka   | Textík  | 1     |
      | Zpráva  | 2010-10-01  | Zprávička | Nějaký  | 1     |
    And I am on the Front Homepage
    When I follow "Novinka"
    Then I should be on "aktuality/aktuality"
    And I should see "Novinka" before "Zprávička"
    And I should see "Textík"
    And I should see "Nějaký"

  @database @slow
  Scenario: News to the event invitation
    Given the following "calendar" exists
      #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | id  | calendar_id |
      | 2   | 1           |
    And the following "news" exists
      | id  | event_id  | type  | heading     | show  |
      | 3   | 2         | Akce  | Superdruper | 1     |
    And I am on the Front Homepage
    When I follow "Superdruper"
    Then I should be on "aktuality/"

  @database @slow
  Scenario: News to the chronicle
    Given the following "calendar" exists
      #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | id  | calendar_id | showchronicle |
      | 2   | 1           | 1             |
    And the following "news" exists
      | id  | event_id  | type    | heading     | show  |
      | 3   | 2         | Kronika | Superdruper | 1     |
    And I am on the Front Homepage
    When I follow "Superdruper"
    Then I should be on "kronika/detail/2"
