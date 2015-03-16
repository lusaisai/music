@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=C:\webserver\php-5.6.6-nts-Win32-VC11-x86;%PATH%
C:\webserver\php-5.6.6-nts-Win32-VC11-x86\RunHiddenConsole.exe C:\webserver\php-5.6.6-nts-Win32-VC11-x86\php-cgi.exe -b 127.0.0.1:9000
