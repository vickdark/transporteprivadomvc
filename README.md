# Configuración de Apache y PHP en Windows (sin XAMPP/Wamp)

## 1. Estructura recomendada de carpetas

    C:\webserver   ├── Apache24   │     ├── bin   │     ├── conf   │     └── htdocs   └── php         ├── ext         └── php.ini

## 2. Habilitar PHP en Apache

En `httpd.conf` agrega:

    LoadModule php_module "C:/webserver/php/php8apache2_4.dll"
    AddType application/x-httpd-php .php
    PHPIniDir "C:/webserver/php"

## 3. Solución a error: No se puede cargar php8apache2_4.dll

Debes usar una versión **Thread Safe (TS)** compatible con Apache 2.4.\
Ejemplo: PHP **8.2.29 TS x64**.

## 4. Advertencia: ServerName no configurado

Agregar en `httpd.conf`:

    ServerName localhost:80

## 5. Instalar Apache como servicio

Ejecutar PowerShell como Administrador:

    C:\webserver\Apache24in\httpd.exe -k install

## 6. Iniciar Apache

    net start Apache2.4

o

    C:\webserver\Apache24in\httpd.exe -k start

## 7. Detener Apache

    net stop Apache2.4

o

    C:\webserver\Apache24in\httpd.exe -k stop

## 8. Reiniciar Apache

    C:\webserver\Apache24in\httpd.exe -k restart

## 9. Evitar que Apache inicie automáticamente

Abrir `services.msc` → Apache2.4 → Tipo de inicio → **Manual**.
