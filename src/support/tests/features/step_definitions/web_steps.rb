Then(/^I should be on "(.*?)"$/) do |subpath|
  assert current_path.include?(subpath)
end


# Make sure that one string (regexp) occurs before or after another one
#   on the same page

Then /I should see "(.*)" before "(.*)"/ do |e1, e2|
  first_position = page.body.force_encoding('UTF-8').index(e1)
  second_position = page.body.force_encoding('UTF-8').index(e2)
  assert_operator first_position, :<, second_position
end

When /^(?:|I )press "([^"]*)"$/ do |button|
  click_button(button)
end

When /^(?:|I )follow "([^"]*)"$/ do |link|
  click_link(link)
end

When /^(?:|I )fill in "([^"]*)" with "([^"]*)"$/ do |field, value|
  fill_in(field, :with => value)
end

When /^(?:|I )fill in "([^"]*)" for "([^"]*)"$/ do |value, field|
  fill_in(field, :with => value)
end

# Use this to fill in an entire form with data from a table. Example:
#
#   When I fill in the following:
#     | Account Number | 5002       |
#     | Expiry date    | 2009-11-01 |
#     | Note           | Nice guy   |
#     | Wants Email?   |            |
#
# TODO: Add support for checkbox, select or option
# based on naming conventions.
#
When /^(?:|I )fill in the following:$/ do |fields|
  fields.rows_hash.each do |name, value|
    step %{I fill in "#{name}" with "#{value}"}
  end
end

When /^(?:|I )select "([^"]*)" from "([^"]*)"$/ do |value, field|
  select(value, :from => field)
end

When /^(?:|I )check "([^"]*)"$/ do |field|
  check(field)
end

When /^(?:|I )uncheck "([^"]*)"$/ do |field|
  uncheck(field)
end

When /^(?:|I )choose "([^"]*)"$/ do |field|
  choose(field)
end

When /^(?:|I )attach the file "([^"]*)" to "([^"]*)"$/ do |path, field|
  attach_file(field, File.expand_path(path))
end

Then /^(?:|I )should see "([^"]*)"$/ do |text|
    assert find('body').has_content?(text)
end

Then /^(?:|I )should see \/([^\/]*)\/$/ do |regexp|
    regexp = Regexp.new(regexp)
    assert find('body').has_xpath?('//*', :text => regexp)
end

Then /^(?:|I )should not see "([^"]*)"$/ do |text|
    assert find('body').has_no_content?(text)
end

Then /^(?:|I )should not see \/([^\/]*)\/$/ do |regexp|
  regexp = Regexp.new(regexp)
    assert find('body').has_no_xpath?('//*', :text => regexp)
end

Then /^show me the page$/ do
  save_and_open_page
end

