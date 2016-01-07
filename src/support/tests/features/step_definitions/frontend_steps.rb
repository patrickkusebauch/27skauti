Then(/^I should see "(.*?)" in "(.*?)"$/) do |text, place|
    assert find(place).has_content?(text)
end

Given /^I am on the Front Homepage$/ do
    visit "http://localhost/27skauti/www"
end

When(/^I click on a photo$/) do
    find("#photogalery").first('a').click
end

Then(/^I should see the photo in a new window$/) do
    assert page.driver.browser.window_handles.size == 2
end

When(/^I hover over "(.*?)"$/) do |selector|
  find(selector).hover
end

Given(/^I am in the Activation page with username "(.*?)" and code "(.*?)"$/) do |username, token|
    visit('/prihlaseni/aktivace?username=' + username + '&token=' + token)
end

Given(/^I am in the Recover page with username "(.*?)" and code "(.*?)"$/) do |username, token|
    visit('/prihlaseni/recover?username=' + username + '&token=' + token)
end