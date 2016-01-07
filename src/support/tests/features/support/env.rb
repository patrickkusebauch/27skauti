require 'rspec/expectations'
require 'capybara'
require 'capybara/mechanize'
require 'capybara/cucumber'
require 'test/unit/assertions'
require 'mechanize'
require "mail_catcher"

World(Test::Unit::Assertions)
	Capybara.default_driver = :mechanize
	Capybara.app = "make sure this isn't nil"
	Capybara.app_host = "http://localhost/27skauti/www"
	Capybara.ignore_hidden_elements = false
World(Capybara)
