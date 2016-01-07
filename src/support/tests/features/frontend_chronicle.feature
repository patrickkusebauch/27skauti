Feature: Chronicle from events

  As a member of the group
  In order to remind myself of past experiences
  I want to see chronicle from past event

  Background:
    Given I am on the Front Homepage
    And I follow "Kronika"

    @database @slow
    Scenario: Chronicle from homepage
      Given the following "calendar" exists
        #can be used for calendar_id and dates
        | id  | year  | yearpart  | show  |
        | 1   | 2013  | jaro      | 1     |
      And the following "event" exists
        | id  | calendar_id | showchronicle |
        | 2   | 1           | 1             |
      And I am on the Front Homepage
      When I click on a photo
      Then I should be on "kronika/detail/2"

  @database @slow
    Scenario: Chronicle Overview
      Given the following "calendar" exists
      #can be used for calendar_id and dates
        | id  | year  | yearpart  | show  |
        | 1   | 2013  | jaro      | 1     |
        | 2   | 2012  | podzim    | 0     |
      And the following "event" exists
        | calendar_id | datestart   | dateend     | type      | name        | route   | showchronicle |
        | 1           | 2013-05-11  | 2013-05-11  | Výprava   | Na Farskou  | Liberec | 1             |
        | 2           | 2012-10-11  | 2012-10-15  | Vícedeňka | Za hudbou   | Praha   | 1             |
      When I follow "2012/2013"
      Then I should see "Na Farskou"
      And I should see "Liberec"
      And I should see "Na Farskou" before "Za hudbou"

  @database @glacial
  Scenario Outline: Chronicle detail with text
    Given the following "calendar" exists
     #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
      | 5   | 2000  | jaro      | 0     |
    And the following "member" exists
    #can be used for chroniclewriter
      | nickname  |
      | Luck      |
      | Kim       |
      | Johny     |
    And the following "event" exists
      | calendar_id | datestart   | dateend     | type    | name        | chroniclewriter | route   | rangers     | tucnaci   | mloci | novacci | content       | showchronicle |
      |<calendar_id>|<datestart>  |<dateend>    |<type>   |<name>       |<chroniclewriter>|<route>  |<rangers>    |<tucnaci>  |<mloci>|<novacci>|<content>      |<showchronicle>|
    When I follow "<skrok>"
    And I follow "<name>"
    Then I should see "<name>"
    And I should see "<chroniclewriter>"
    And I should see "<route>"
    And I should see "<rangers>"
    And I should see "<tucnaci>"
    And I should see "<mloci>"
    And I should see "<novacci>"
    And I should see "<content>"
  Examples:
    | calendar_id | datestart   | dateend     | type      | name        | chroniclewriter | route   | rangers     | tucnaci   | mloci | novacci | content       | showchronicle | skrok     |
    | 1           | 2013-05-11  | 2013-05-11  | Výprava   | Na Farskou  | Luck            | Liberec | Pajda, Kim  | Šíp, Zip  | Tonda | Blesk   | Text kroniky  | 1             | 2012/2013 |
    | 1           | 2013-06-11  | 2013-06-15  | Vícedeňka | Za hudbou   | Johny           | Liberec | Pajda       | Johny     |       | Blesk   | Text kroniky  | 1             | 2012/2013 |
    | 5           | 2000-05-11  | 2000-05-11  | Výprava   | Hamr        | Kim             | Liberec | Pajda, Kim  | Šíp, Zip  | Tonda |         | Text kroniky  | 1             | 1999/2000 |

  @database @glacial
  Scenario Outline: Chronicle detail with no text no photos no video
    Given the following "calendar" exists
     #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
      | 2   | 2013  | podzim    | 0     |
      | 5   | 2000  | jaro      | 0     |
    And the following "event" exists
      | calendar_id | datestart   | dateend     | type    | name        | route   | rangers     | tucnaci   | mloci | novacci | showchronicle |
      |<calendar_id>|<datestart>  |<dateend>    |<type>   |<name>       |<route>  |<rangers>    |<tucnaci>  |<mloci>|<novacci>|<showchronicle>|
    When I follow "<skrok>"
    And I follow "<name>"
    Then I should see "<name>"
    And I should see "<route>"
    And I should see "<rangers>"
    And I should see "<tucnaci>"
    And I should see "<mloci>"
    And I should see "<novacci>"
    And I should not see "Zápis"
    And I should not see "Video"
    And I should not see "Fotky"
  Examples:
    | calendar_id | datestart   | dateend     | type      | name        | route   | rangers     | tucnaci   | mloci | novacci | showchronicle | skrok     |
    | 1           | 2013-05-11  | 2013-05-11  | Výprava   | Na Farskou  | Liberec | Pajda, Kim  | Šíp, Zip  | Tonda | Blesk   | 1             | 2012/2013 |
    | 2           | 2013-05-14  | 2013-05-14  | Schůzka   | Družinovka  |         | Pajda, Kim  | Šíp, Zip  | Tonda | Blesk   | 1             | 2013/2014 |
    | 1           | 2013-06-11  | 2013-06-15  | Vícedeňka | Za hudbou   | Liberec | Pajda       | Johny     |       | Blesk   | 1             | 2012/2013 |
    | 5           | 2000-05-11  | 2000-05-11  | Výprava   | Hamr        | Liberec | Pajda, Kim  | Šíp, Zip  | Tonda |         | 1             | 1999/2000 |

  @database @slow
    Scenario: Chronicle not published not visible
      Given the following "calendar" exists
      #can be used for calendar_id and dates
       | id  | year  | yearpart  | show  |
       | 1   | 2013  | jaro      | 1     |
      And the following "event" exists
       | calendar_id  | name      | showchronicle |
       | 1            | Za humny  | 0             |
      When I follow "2012/2013"
      Then I should not see "Za humby"

  @database @slow
    Scenario: Chronicle detail with videos
    Given the following "calendar" exists
    #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | id  | calendar_id  | name      | showchronicle |
      | 2   | 1            | Za humny  | 1             |
    And the following "chronicle_videos" exists
      | event_id  | input | note    |
      | 2         | http  | popisek |
    When I follow "2012/2013"
    And I follow "Za humny"
    Then I should see "Videa"
    And I should see "popisek"

  @database @glacial @javascript
  Scenario: Chronicle detail with photos
    Given the following "calendar" exists
    #can be used for calendar_id and dates
      | id  | year  | yearpart  | show  |
      | 1   | 2013  | jaro      | 1     |
    And the following "event" exists
      | id  | calendar_id  | name      | showchronicle |
      | 2   | 1            | Za humny  | 1             |
    And the following "chronicle_photos" exists
      | event_id  | order | text    |
      | 2         | 0004  | popisek |
    When I hover over ".drop-paginator"
    And I follow "2012/2013"
    And I follow "Za humny"
    Then I should see "Fotky"
    And I should see "popisek"
    When I click on a photo
    Then I should see the photo in a new window

  @database @slow
    Scenario: History
      Given the following "history" exists
       | year       | game  | leaders | deputies  | oldscouts | rangers   | club      | camp    | mloci     | tucnaci | jezevci |
       | 2010-2011  | ???   | Zip     | Kim, Krab | Kiwi, Jim | Šíp, Opic | Hanychov  | Zábrtka | Orel, Bee | Fretka  |         |
       | 2009-2010  | Rally |         |           |           | Opic      | ???       | ???     |           |         |         |
    When I follow "Historie Oddílu"
    Then I should see "Zip"
    And I should see "Kim, Krab"
    And I should see "Šíp"
    And I should see "Hanychov"
    And I should see "Zábrtka"
    And I should see "Orel, Bee"
    And I should see "Fretka"
    And I should see "Rally"
    And I should see "2010-2011" before "2009-2010"

  @local @fast
    Scenario: VIP Chronicle
      When I follow "VIP Kronika"
      Then I should see "VIP kronika zatím není přístupná"