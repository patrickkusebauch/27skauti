Feature: Events

  As an omnipotent admin of the website
  In order to provide new content
  I want to be able to create, edit, show a delete events and calendars

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
  Scenario Outline: Create calendar
    And I follow "Akce"
    And I should not see "<yearpart>"
    When I follow "Přidat Kalendář"
    And I fill in "year" with "<year>"
    And I select "<yearpart>" from "yearpart"
    And I press "Přidat"
    Then I should see "<year>"
    And I should see "<yearpart>"
  Examples:
    | year | yearpart |
    | 2012 | jaro     |
    | 2012 | podzim   |

  @database @slow
  Scenario: Show/Unshow calendar
    And the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And I follow "Akce"
    Then I should see "Zobraz"
    When I follow "Zobraz"
    Then I should see "Odzobraz"
    And the following "calendar" should exist
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 1    |
    When I follow "Odzobraz"
    Then I should see "Zobraz"
    And the following "calendar" should exist
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |

  @database @slow
  Scenario: Add event to calendar
    And the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And I follow "Akce"
    And I follow "Edituj"
    When I fill in "events[0][datestart]" with "03.05.2012"
    And I fill in "events[0][dateend]" with "03.05.2012"
    And I select "Výprava" from "events[0][type]"
    And I fill in "events[0][calendarnote]" with "Poznámka"
    And I fill in "events[0][leaders]" with "Zip, Kim"
    And I press "Zpracovat"
    When I follow "2011/2012"
    Then I should see "3. 5."
    And I should see "Výprava"

  @database @slow
  Scenario: Edit event in calendar
    And the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     |
    And I follow "Akce"
    And I follow "Edituj"
    And I select "VIP" from "events[2][type]"
    And I press "Zpracovat"
    When I follow "2011/2012"
    Then I should see "VIP"

  @database @slow
  Scenario: Delete an event
    And the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     |
    And I follow "Akce"
    When I follow "2011/2012"
    Then I should see "Výprava"
    When I follow "Smaž"
    Then I should not see "Výprava"

  @database @slow
  Scenario: Edit an event
    And the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     |
    And the following "user" exists
      | id | username | mail               |
      | 4  | admin    | root@localhost.net |
    And the following "member" exists
      | user_id | nickname | title | name    | surname   |
      | 4       | Luck     | BSci. | Patrick | Kusebauch |
    And the following "registration" exists
      | member_nickname | mobile    |
      | Luck            | 123123123 |
    And I am on the Edit event page with id "2"
    When I fill in "name" with "Jméno akce"
    And I fill in "text" with "Úvodní text lístečku..."
    And I fill in "frm-editEventForm-event_meeting-0-starttime" with "2012-05-03 09:00"
    And I fill in "frm-editEventForm-event_meeting-0-startplace" with "na Fügnerce"
    And I fill in "frm-editEventForm-event_meeting-0-endtime" with "2012-05-03 16:00"
    And I fill in "frm-editEventForm-event_meeting-0-endplace" with "před klubovnou"
    And I fill in "equipment" with "Co si s sebou máme vlastně vzít"
    And I select "Luck" from "contactperson"
    And I press "Změnit"
    Then I should see "Lísteček byl úspěšně upraven"
