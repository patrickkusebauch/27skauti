require 'mysql2'

Before('@database') do
	truncate_all
end

After('@database') do
	truncate_all
end

def truncate_all
 @connection = Mysql2::Client.new(host: 'localhost', username: 'root', password: '', database: '27skauti_testing')
 sql = 'SET FOREIGN_KEY_CHECKS = 0'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE news'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE chronicle_photos'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE chronicle_videos'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE event_meeting'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE event'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE registration'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE guestbook'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE history'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE member'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE privilege'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE calendar'
 @connection.query(sql)
 sql = 'TRUNCATE TABLE user'
 @connection.query(sql)
 sql = 'SET FOREIGN_KEY_CHECKS = 1'
 @connection.query(sql)
end
