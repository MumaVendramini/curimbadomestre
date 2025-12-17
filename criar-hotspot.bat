@echo off
echo ========================================
echo  Configurar Hotspot WiFi no Windows
echo ========================================
echo.
echo Clique com botao direito neste arquivo
echo e selecione "Executar como administrador"
echo.
echo Nome da Rede: CurimbaTeste
echo Senha: teste1234
echo.
pause

netsh wlan set hostednetwork mode=allow ssid=CurimbaTeste key=teste1234
netsh wlan start hostednetwork

echo.
echo ========================================
echo  Hotspot criado com sucesso!
echo ========================================
echo.
echo Nome: CurimbaTeste
echo Senha: teste1234
echo.
echo Conecte seu celular nesta rede WiFi
echo e acesse: 10.10.23.47:8000
echo.
pause
