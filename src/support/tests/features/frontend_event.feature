Feature: Event with calendar

  As a group member
  In order to have the maximal attendance
  I want to know when and where the next thing will happen

  Background:
    Given I am on the Front Homepage

  @database @slow
  Scenario: Calendar
    Given the following "calendar" exists
    #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
      | 3   | 2013  | podzim    | 1     |
      | 2   | 2012  | podzim    | 0     |
    And the following "event" exists
      | calendar_id | datestart   | dateend     | type      | calendarnote  | leaders |
      | 1           | 2013-05-11  | 2013-05-11  | Schůzka   | Družinovka    | Zip     |
      | 1           | 2013-06-11  | 2013-06-11  | Výprava   | Na Farskou    | Kim     |
      | 2           | 2012-10-11  | 2012-10-15  | Vícedeňka | Za hudbou     | Krab    |
      | 3           | 2013-11-11  | 2013-11-13  | Vícedeňka |               | Luck    |
    When I follow "Aktuality/Akce"
    Then I should see "Kalendář"
    And I should see "Jaro 2013" before "Podzim 2013"
    And I should not see "Podzim 2012"
    And I should see "Schůzka"
    And I should see "Družinovka" before "Na Farskou"
    And I should not see "Za hudbou"
    And I should see "Luck"

  @database @slow
  Scenario: Event invitation not showing
    Given the following "calendar" exists
    #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | calendar_id  | dateend    | name      | showevent |
      | 1            | 9999-12-31 | Za humny  | 0         |
      | 1            | 1000-01-01 | Jiny      | 1         |
    When I follow "Aktuality/Akce"
    Then I should not see "Za humny"
    And I should not see "Jiny"

  @database @slow
  Scenario Outline: Simple event invitation
    Given the following "calendar" exists
    #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | calendar_id  | datestart  | dateend     | name  | text  | equipment | showevent |
      |<calendar_id> | 9999-12-31 | 9999-12-31  |<name> |<text> |<equipment>|<showevent>|
    When I follow "Aktuality/Akce"
    Then I should see "<name>"
    And I should see "<text>"
    And I should see "<equipment>"
    Examples:
      | calendar_id  | name      | text       | equipment | showevent |
      | 1            | Za humny  | Ahoj děcka | Lžíci     | 1         |

    @database @slow
    Scenario: Morse encoder
      Given the following "calendar" exists
      #can be used for calendar_id and dates
        | id  | year  | yearpart  | show  |
        | 1   | 2013  | jaro      | 1     |
      And the following "event" exists
        | calendar_id  | datestart  | dateend     | name      | text       | equipment | morse     | showevent |
        | 1            | 9999-12-31 | 9999-12-31  | Za humny  | Ahoj děcka | Lžíci     | ahoj lidi | 1         |
      When I follow "Aktuality/Akce"
      Then I should see "///.-/..../---/.---//.-../../-../..///"

    @database @slow
    Scenario: Event ordering
      Given the following "calendar" exists
      #can be used for calendar_id and dates
        | id  | year  | yearpart  | show  |
        | 1   | 2013  | jaro      | 0     |
      And the following "event" exists
        | calendar_id  | datestart  | dateend     | name   | text       | equipment | showevent |
        | 1            | 9999-12-31 | 9999-12-31  | Druhý  | Ahoj děcka | Lžíci     | 1         |
        | 1            | 9999-12-30 | 9999-12-30  | První  | Ahoj děcka | Lžíci     | 1         |
      When I follow "Aktuality/Akce"
      Then I should see "První" before "Druhý"

      @database @slow
      Scenario: Event multiple meetings
        Given the following "calendar" exists
        #can be used for calendar_id and dates
          | id  | year  | yearpart  | show  |
          | 1   | 2013  | jaro      | 0     |
        And the following "event" exists
          | id  | calendar_id  | datestart  | dateend     | name   | text       | equipment | showevent |
          | 2   | 1            | 9999-12-31 | 9999-12-31  | Druhý  | Ahoj děcka | Lžíci     | 1         |
          | 3   | 1            | 9999-12-30 | 9999-12-30  | První  | Ahoj děcka | Lžíci     | 0         |
        And the following "event_meeting" exists
          | event_id  | starttime       | endtime           | startplace  | endplace  | comment   |
          | 2         | 9999-12-31 8:00 | 9999-12-31 16:00  | Hodkovice   | Jablonec  | Běžky     |
          | 2         | 9999-12-31 9:00 | 9999-12-31 17:00  | Modlibohov  | Trávníček | Sjezdovky |
          | 3         | 10:00           | 18:00             |             |           | Chodci    |
        When I follow "Aktuality/Akce"
        Then I should not see "Chodci"
        And I should see "Běžky"
        And I should see "Sjezdovky"
        And I should see "8:00" before "16:00"
        And I should see "9:00" before "17:00"
        And I should see "Hodkovice" before "Jablonec"
        And I should see "Modlibohov" before "Trávníček"

    @database @slow
    Scenario: Event Contact
      Given the following "calendar" exists
      #can be used for calendar_id and dates
        | id  | year  | yearpart  | show  |
        | 1   | 2013  | jaro      | 0     |
      And the following "user" exists
        | id  | username  | mail                |
        | 4   | admin     | root@localhost.net  |
      And the following "member" exists
        | user_id | nickname  | title | name    | surname   |
        | 4       | Luck      | BSci. | Patrick | Kusebauch |
      And the following "registration" exists
        | member_nickname | mobile    |
        | Luck            | 123123123 |
      And the following "event" exists
        | id  | calendar_id  | datestart  | dateend     | name   | contactperson  | text       | equipment | showevent |
        | 2   | 1            | 9999-12-31 | 9999-12-31  | Druhý  | Luck           | Ahoj děcka | Lžíci     | 1         |
      When I follow "Aktuality/Akce"
      Then I should see "Luck"
      And I should see "BSci. Patrick Kusebauch"
      And I should see "root@localhost.net"
      And I should see "123123123"
