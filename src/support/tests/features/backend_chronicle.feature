Feature: Chronicle manipulation

  As a omnipotent admin of the website
  In order to share memories from events
  I want to be able to manipulate chronicles from events

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
  Scenario: Photo fixing (on drive but not in database)
    When I follow "Kronika"
    And I follow "oprava fotek"
    And I select "19901991" from "folder"
    And I press "Opravit"
    Then I should see "Oprava fotek byla dokončena"

  @database @slow
  Scenario: Chronicle delete
    Given the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders | name            |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     | Vanoční výprava |
    When I follow "Kronika"
    And I follow "2011/2012"
    Then I should see "Vanoční výprava"
    When I follow "Smaž"
    Then I should not see "Vanoční výprava"

  @database @slow
  Scenario: Chronicle display
    Given the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders | name            |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     | Vanoční výprava |
    When I follow "Kronika"
    And I follow "2011/2012"
    Then I should see "Zobraz"
    When I follow "Zobraz"
    Then I should not see "Odzobraz"

  @database @slow
  Scenario: Chronicle text
    Given the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders | name            |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     | Vanoční výprava |
    And the following "user" exists
      | id | username | mail               |
      | 4  | admin    | root@localhost.net |
    And the following "member" exists
      | user_id | nickname | title | name    | surname   |
      | 4       | Luck     | BSci. | Patrick | Kusebauch |
    And the following "registration" exists
      | member_nickname | mobile    |
      | Luck            | 123123123 |
    When I follow "Kronika"
    And I follow "2011/2012"
    And I follow "T"
    And I fill in "rangers" with "Zip, Kim"
    And I fill in "mloci" with ""
    And I fill in "tucnaci" with ""
    And I fill in "novacci" with ""
    And I fill in "route" with ""
    And I fill in "content" with ""
    And I select "Luck" from "chroniclewriter"
    And I press "Upravit"
    Then I should see "Kronika byla úspěšně upravena"

  @database @slow
  Scenario: Chronicle photos' labels
    Given the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders | name            |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     | Vanoční výprava |
    And the following "chronicle_photos" exists
      | id | event_id  | order | text    |
      | 3  | 2         | 0004  | popisek |
      | 4  | 2         | 0006  | Textík  |
    When I follow "Kronika"
    And I follow "2011/2012"
    And I follow "F"
    And I fill in "frm-labelPhotosForm-chronicle_photos-4-text" with "popisek fotky"
    And I press "Přidat popisky"
    Then I should see "Popisky byly úspěšně přidány"

  @database @slow
  Scenario: Chronicle videos
    Given the following "calendar" exists
      | id | year | yearpart | show |
      | 1  | 2012 | jaro     | 0    |
    And the following "event" exists
      | id | calendar_id | datestart  | dateend    | type    | calendarnote | leaders | name            |
      | 2  | 1           | 2012-05-03 | 2012-05-03 | Výprava | Vánočka      | Kim     | Vanoční výprava |
    When I follow "Kronika"
    And I follow "2011/2012"
    And I follow "V"
    And I fill in "frm-labelVideosForm-chronicle_videos-0-note" with "text"
    And I fill in "frm-labelVideosForm-chronicle_videos-0-input" with "html code"
    And I press "Odeslat"
    Then I should see "Videa ke kronice byla úspěčně editována"

    #TODO repeatable photo upload test
