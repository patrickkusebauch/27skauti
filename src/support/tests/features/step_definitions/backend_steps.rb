When(/^I am on the Edit event page with id "(.*?)"$/) do |id|
    visit('/admin/event/edit/' + id)
end