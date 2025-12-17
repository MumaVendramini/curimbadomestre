@echo off
echo ========================================
echo  Configurando Firewall para Laravel
echo ========================================
echo.
echo Clique com botao direito neste arquivo
echo e selecione "Executar como administrador"
echo.
pause

netsh advfirewall firewall delete rule name="Laravel Server 8000"
netsh advfirewall firewall add rule name="Laravel Server 8000" dir=in action=allow protocol=TCP localport=8000

echo.
echo ========================================
echo  Firewall configurado com sucesso!
echo ========================================
echo.
pause
