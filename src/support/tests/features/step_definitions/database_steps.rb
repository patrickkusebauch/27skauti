require 'mysql2'
require 'set'

Given(/^the following "(.*?)" exists$/) do |name, table|
  @con = Mysql2::Client.new(host: 'localhost', username: '27skauti_testing', password: 'dominika', database: '27skauti_testing')
  @sql =  "INSERT INTO `" +  @con.escape(name) + "` (`"
  @columns = table.column_names.each {|x| @con.escape(x)}
  @columns = @columns.join("`, `")
  @sql = @sql + @columns + '`) VALUES '
  @values = []
  table.hashes.each do |member| # this is the tabel row
     @value = member.values.each {|value| @con.escape(value)} # get values from row
     @value = @value.join('", "')
     @value = '("' + @value + '")'
     @values = @values.push(@value)
  end
  @values = @values.join(', ')
  @sql = @sql + @values
  @con.query(@sql)
end

Then(/^the following "(.*?)" should exist$/) do |name, table|
  @con = Mysql2::Client.new(host: 'localhost', username: '27skauti_testing', password: 'dominika', database: '27skauti_testing')
  @sql =  "SELECT `"
  @columns = table.column_names.each {|x| @con.escape(x)}
  @columns = @columns.join("`, `")
  @sql = @sql + @columns + '` FROM `' +  @con.escape(name) + '`'
  @result = @con.query(@sql).to_a
  # converts all values to Strings
  @result.map! do |obj|
    obj.each do |k, v|
        obj[k] = "#{v}"
    end
  end
  @result = @result.to_a.to_set
  @input = table.hashes.to_set
  assert @input.subset?(@result)
end