Feature: User creation

  As a visitor to the website
  In order to change items on the page
  I want to be log in as a user

  Background:
    Given I am on the Front Homepage

  @database @slow @mail
  Scenario: User registration
    When I follow "Registrace"
    When I fill in the following:
      | registration_username | Luck                |
      | registration_password | dvacetsedm          |
      | password_confirm      | dvacetsedm          |
      | mail                  | root@localhost.net  |
    And I press "Registrovat"
    Then I should see "Registrace proběhla úspěšně"
    Then the following "user" should exist
      | username | mail               | active  |
      | Luck     | root@localhost.net | 0       |

  @database @slow
  Scenario: User Activation
    Given the following "user" exists
      | username | mail               | active  | token                       | issuedate   |
      | Luck     | root@localhost.net | 0       | 12345678901234567890        | 9999-12-31  |
    Given I am in the Activation page with username "Luck" and code "12345678901234567890"
    Then I should see "Váš účet byl aktivován"
    And the following "user" should exist
      | username | mail               | active  |
      | Luck     | root@localhost.net | 1       |

  @database @slow
  Scenario: Forgotten password via username
    Given the following "user" exists
      | username | mail               | active  |
      | Luck     | root@localhost.net | 1       |
    And I am on the Front Homepage
    When I follow "Zapomenuté heslo"
    And I fill in "forgot_username" with "Luck"
    And I press "Odeslat"
    Then I should see "Postup pro obnovení hesla byl odeslán na e-mail"

  @database @slow
    Scenario: Forgotten password wrong info
      Given the following "user" exists
        | username | mail               | active  |
        | Luck     | root@localhost.net | 1       |
      And I am on the Front Homepage
      When I follow "Zapomenuté heslo"
      And I fill in "forgot_username" with "Rak"
      And I fill in "mail" with "random@lolahost.net"
      And I press "Odeslat"
      Then I should see "Uživatel s tímto jménem nebo e-mailem neexistuje"

  @database @slow
  Scenario: Recover forgotten password from mail
    Given the following "user" exists
      | username | mail               | active  | token                       | issuedate   |
      | Luck     | root@localhost.net | 1       | 12345678901234567890        | 9999-12-31  |
    Given I am in the Recover page with username "Luck" and code "12345678901234567890"
    When I fill in "recover_password" with "heslo"
    And I fill in "password_confirm" with "heslo"
    And I press "Změnit"
    Then I should see "Heslo bylo úspěšně změněno"

  @database @slow
  Scenario: Log in, log out
    Given the following "user" exists
      | id  | username  | password                                                      | active  |
      | 1   | Luck      | $2y$10$4Op3A83MkfaaIDAge9uZ6.eNhoxyfvwwysRArnNO65Qb.iLRRpKcu  | 1       |
    And the following "privilege" exists
      | user_id | base  |
      | 1       | člen  |
    Given I am on the Front Homepage
    When I fill in "username" with "Luck"
    And I fill in "password" with "dvacetsedm"
    And I press "Přihlásit"
    Then I should see "Odhlásit se"
    When I follow "Odhlásit se"
    Then I should see "Odhlášení proběhlo úspěšně"
