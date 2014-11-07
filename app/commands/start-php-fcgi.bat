@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=C:\webtools\php-5.6.2-Win32-VC11-x86;%PATH%
C:\webtools\php-5.6.2-Win32-VC11-x86\RunHiddenConsole.exe C:\webtools\php-5.6.2-Win32-VC11-x86\php-cgi.exe -b 127.0.0.1:9000
